<?php

namespace App\Http\Controllers\api\v1;

use PDF;
use Event;
use App\Models\AppUser;
use App\Models\ResumePdf;
use Illuminate\Http\Request;
use App\Events\SendResumeBuilder;
use App\Helpers\FileUploadHelper;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Traits\ImageUploadTrait;
use App\Mail\AppUserTempRegisterMail;
use App\Http\Requests\LoginApiRequest;
use App\Mail\AppUserForgotPasswordMail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AboutUsApiRequest;
use App\Http\Requests\JobDisableRequest;
use App\Http\Requests\DeviceTokenRequest;
use App\Models\ResumeBuilderSubscription;
use App\Http\Requests\ResendOtpApiRequest;
use App\Http\Requests\VerifyOtpApiRequest;
use App\Http\Requests\RegisterV2ApiRequest;

use App\Http\Requests\AppUserVideoApiRequest;
use App\Http\Requests\MarkNotificationRequest;
use App\Http\Requests\ResetPasswordApiRequest;
use App\Interfaces\AppUserRepositoryInterface;
use App\Http\Requests\ForgotPasswordApiRequest;
use App\Interfaces\AppUserTempRepositoryInterface;

class AppUserController extends Controller
{
    use ImageUploadTrait;

    protected $appUserRepository = "";
    protected $appUserTempRepository = "";
    protected $appUser = "";
    public function __construct(AppUserRepositoryInterface $appUserRepository, AppUserTempRepositoryInterface $appUserTempRepository, AppUser $appUser)
    {
        $this->appUserRepository = $appUserRepository;
        $this->appUserTempRepository = $appUserTempRepository;
        $this->appUser = $appUser;
    }

    public function signUp(RegisterV2ApiRequest $request)
    {

        $reqData = $request->all();

        if (!empty($reqData['user_id'])) {
            $result = $this->appUserRepository->updateUserWithId($reqData['user_id'], $reqData);
            if ($result) {
                return $this->sendResponse(true, [$result], trans('messages.custom.update_messages', ["attribute" => "User"]), $this->successStatus);
            }
        } else {
            $otp = rand(1000, 9999);
            $reqData['otp'] = $otp;
            $reqData['first_name'] = $reqData['first_name'];
            $reqData['password'] = Hash::make($reqData['password']);
            $result = $this->appUserTempRepository->store($reqData);

            if ($result) {
                try {
                    Mail::to($result->email)->send(new AppUserTempRegisterMail($reqData));
                } catch (\Exception $e) {
                    Log::error('Email sending failed: ' . $e->getMessage());
                }
                $sendResponse = [
                    'id' => $result->id,
                    'otp' => $otp,
                ];
                return $this->sendResponse(true, [$sendResponse], trans('messages.custom.register_messages', ["attribute" => "User"]), $this->successStatus);
            }
        }

        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function aboutUs(AboutUsApiRequest $request)
    {
        $reqData = $request->all();
        $reqData['tell_us_about_screen'] = 1;
        $id = Auth::user()->id;
        $result = $this->appUserRepository->updateUserWithId($id, $reqData);
        if ($result) {
            return $this->sendResponse(true, [$result], trans('messages.custom.update_messages', ["attribute" => "Tell Us About"]), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function verifyRegisterOtp(VerifyOtpApiRequest $request)
    {
        $result = $this->appUserTempRepository->getSingalUserData('id', $request->user_id);
        if ($result) {
            if ($request->otp == $result->otp) {
                $this->appUserTempRepository->updateUserWithId($result->id, ['otp' => null]);
                $user = $this->appUserRepository->store($result->toArray());
                $this->appUserTempRepository->delete($result->id);
                $user['access_token'] = $user->createToken('MyAuthApp')->plainTextToken;
                $this->appUserRepository->updateUserWithId($user->id, ["access_token" => $user['access_token'], 'otp' => null]);
                $user['profile_photo_url'] = FileUploadHelper::getImage($user['profile_photo_path'], 'app_users');
                return $this->sendResponse(true, [$user], trans('messages.custom.otp_message'), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('messages.custom.otp'), $this->failedStatus);
            }
        } else {
            return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
        }
    }

    public function signIn(LoginApiRequest $request)
    {
        $result = $this->appUserRepository->login($request);
        return $this->sendResponse($result['status'], $result['status'] ? [$result['data']] : [], $result['msg'], $result['status'] == true ? $this->successStatus : $this->failedStatus);
    }

    public function verifyOtp(VerifyOtpApiRequest $request)
    {
        $result = $this->appUserRepository->getSingalUserData('id', $request->user_id);
        if ($result) {
            if ($request->otp == $result->otp) {
                $this->appUserRepository->updateUserWithId($result->id, ['otp' => null]);
                $sendResponse = [
                    'id' => $result->id,
                ];
                return $this->sendResponse(true, [$sendResponse], trans('messages.custom.otp_message'), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('messages.custom.otp'), $this->failedStatus);
            }
        } else {
            return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
        }
    }

    public function resendOtp(ResendOtpApiRequest $request)
    {
        if (isset($request->register) && $request->register == true) {
            $result = $this->appUserTempRepository->getSingalUserData('id', $request->user_id);
        } else {
            $result = $this->appUserRepository->getSingalUserData('id', $request->user_id);
        }
        if ($result) {
            $otp = rand(1000, 9999);
            $data = [
                'otp' => $otp,
                'first_name' => $result->first_name,
            ];
            if (isset($request->register) && $request->register == true) {
                $this->appUserTempRepository->updateUserWithId($result->id, ['otp' => $otp]);
                try {
                    Mail::to($result->email)->send(new AppUserTempRegisterMail($data));
                } catch (\Exception $e) {
                    Log::error('Email sending failed: ' . $e->getMessage());
                }
            } else {
                $this->appUserRepository->updateUserWithId($result->id, ['otp' => $otp]);
                try {
                    Mail::to($result->email)->send(new AppUserForgotPasswordMail($data));
                } catch (\Exception $e) {
                    Log::error('Email sending failed: ' . $e->getMessage());
                }
            }
            $sendResponse = [
                'id' => $result->id,
                'otp' => $otp,
            ];
            return $this->sendResponse(true, [$sendResponse], trans('messages.custom.resend_otp_message'), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function forgotPassword(ForgotPasswordApiRequest $request)
    {
        $result = $this->appUserRepository->getSingalUserData('email', $request->email);
        if ($result) {
            $otp = rand(1000, 9999);
            $this->appUserRepository->updateUserWithId($result->id, ['otp' => $otp]);
            $data = [
                'otp' => $otp,
            ];
            try {
                Mail::to($result->email)->send(new AppUserForgotPasswordMail($data));
            } catch (\Exception $e) {
                Log::error('Email sending failed: ' . $e->getMessage());
            }
            $sendResponse = [
                'id' => $result->id,
                'otp' => $otp,
            ];
            return $this->sendResponse(true, [$sendResponse], trans('messages.custom.resend_otp_message'), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('messages.custom.invalid_user'), $this->failedStatus);
    }

    public function resetPassword(ResetPasswordApiRequest $request)
    {
        $result = $this->appUserRepository->getSingalUserData('id', $request->user_id);
        if ($result) {
            $updateAppUser = $this->appUserRepository->updateUserWithId($result->id, ['password' => Hash::make($request->password)]);
            if ($updateAppUser) {
                $sendResponse = [
                    'id' => $result->id,
                ];
                return $this->sendResponse(true, [$sendResponse], trans(
                    'messages.custom.reset_messages',
                    ["attribute" => "Password"]
                ), $this->successStatus);
            }
            return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
        } else {
            return $this->sendResponse(false, [], trans('messages.custom.invalid_user'), $this->failedStatus);
        }
    }

    public function saveVideo(AppUserVideoApiRequest $request)
    {
        $userId = Auth::user()->id;
        if ($request->skip == 1 && $request->skip == true && $request->skip == "true") {
            $msg = 'messages.custom.skip_messages';
            $updateAppUser = $this->appUserRepository->updateUserWithId($userId, ['upload_video_screen' => 1]);
        } else {
            if ($request->video != null) {
                $fileName = $this->storeImage($request->file('video'), 'app_user_videos');
                $data = [];
                $data['video'] = $fileName;
            }
            $data['upload_video_screen'] = 1;
            $msg = 'messages.custom.create_messages';
            $updateAppUser = $this->appUserRepository->updateUserWithId($userId, $data);
        }
        if ($updateAppUser) {
            $user = $this->appUserRepository->getSingalUserData('id', $userId);
            return $this->sendResponse(true, [$user], trans(
                $msg,
                ["attribute" => "Video"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function logout()
    {
        $result = $this->appUserRepository->logout();
        if ($result) {
            return $this->sendResponse(true, [], trans(
                'messages.custom.logout_messages',
                ["attribute" => "User"]
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
        }
    }

    public function getUserInformation()
    {
        $id = Auth::user()->id;
        $userInformation = $this->appUserRepository->getUserInformation($id);
        $userExperience = $userInformation['user_experience'][0];
        $industryNames = explode(',', $userExperience['industry']);
        $industriesData = $this->appUser->getIndustriesId($industryNames);

        if ($industriesData) {
            $userInformation['profile_photo_path'] = $userInformation['profile_photo_path'] != null ? $this->getImageUrl($userInformation['profile_photo_path']) : null;

            $userData = $userInformation;
            $data['user'] = $userData;
            $data['user']['industries'] = $industriesData;
            return $this->sendResponse(true, $data, trans(
                'validation.get_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.invalid',
                ['attribute' => 'User']
            ), $this->failedStatus);
        }
    }

    public function deleteAccount()
    {
        $deleteAppUser = $this->appUserRepository->delete(Auth::user()->id);
        if ($deleteAppUser) {
            return $this->sendResponse(true, [], trans(
                'messages.custom.delete_messages',
                ["attribute" => "User"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function disableJob(JobDisableRequest $request)
    {
        $deleteAppUser = $this->appUserRepository->updateUserWithId(Auth::user()->id, ['disable_job' => $request->disable_job]);
        if ($deleteAppUser) {
            $msg = $request->disable_job == 0 ? 'messages.custom.enable_messages' : 'messages.custom.disable_messages';
            return $this->sendResponse(true, [], trans(
                $msg,
                ["attribute" => "Job"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function saveDeviceToken(DeviceTokenRequest $request)
    {
        $user = Auth::user();
        $appUser = $this->appUserRepository->updateUserWithId($user->id, ['device_token' => $request->device_token]);
        if ($appUser) {
            $sendResponse = $this->appUserRepository->getSingalUserData('id', $user->id);
            return $this->sendResponse(true, [$sendResponse], trans(
                'messages.custom.update_messages',
                ["attribute" => "User Device"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function getNotification(Request $request)
    {
        $reqData = $request->all();
        $reqData['app_user_id'] = Auth::user()->id;
        $getNotification = $this->appUserRepository->getNotification($reqData);
        return $this->sendResponse(true, $getNotification, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function markAsNotification(MarkNotificationRequest $request)
    {
        $markNotification = $this->appUserRepository->markNotification($request->all());
        if ($markNotification) {
            return $this->sendResponse(true, [], trans(
                'messages.custom.update_messages',
                ["attribute" => "Notification"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function markAllNotification(Request $request)
    {
        $markNotification = $this->appUserRepository->markNotification($request->all());
        if ($markNotification) {
            return $this->sendResponse(true, [], trans(
                'messages.custom.update_messages',
                ["attribute" => "Notification"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('validation.unknown_error'), $this->failedStatus);
    }

    public function resumeBuilderSubscription(Request $request)
    {
        $data = $this->appUserRepository->storeData($request);
        $paymentData = json_decode($data->payment_responce);

        if (isset($paymentData[0]->status)) {

            if ($paymentData[0]->status == "success") {
                event(new SendResumeBuilder($data, $request->resume_format_id));
            } else {
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.create_messages',
                    ["attribute" => "Resume not generate"]
                ), $this->successStatus);
            }
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "Resume Builder User"]
            ), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans(
            'messages.custom.error_messages'
        ), $this->errorStatus);
    }


    public function getMyResume(Request $request)
    {

        $getPdfUrl = $this->appUserRepository->getPdfUrl();
        if(isset($getPdfUrl->resume_pdf_url)){
            $getPdfUrl->resume_pdf_url = $this->getPdfUrl($getPdfUrl->resume_pdf_url);
        }
        if ($getPdfUrl) {
            return $this->sendResponse(true, $getPdfUrl, trans(
                'messages.custom.create_messages',
                ["attribute" => "Resume"]
            ), $this->successStatus);
        }

        return $this->sendResponse(false, [], trans(
            'messages.custom.error_messages',
            ["attribute" => "Resume"]
        ), $this->errorStatus);
    }

    public function getUserPaymentDetail()
    {
        $getPaymentDetail = $this->appUserRepository->getPaymentDetail();
        
        if (is_array($getPaymentDetail)) {
            foreach ($getPaymentDetail as $paymentDetail) {
                if (isset($paymentDetail->resume_pdf_url)) {
                    $paymentDetail->resume_pdf_url = $this->getPdfUrl($paymentDetail->resume_pdf_url);
                }
            }
        }
        
        if ($getPaymentDetail) {
            return $this->sendResponse(true, $getPaymentDetail, trans(
                'messages.custom.create_messages',
                ["attribute" => "User Payment"]
            ), $this->successStatus);
        }

        return $this->sendResponse(false, [], trans(
            'messages.custom.error_messages',
            ["attribute" => "User Payment"]
        ), $this->errorStatus);
    }
}
