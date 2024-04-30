<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginV2Request;
use App\Http\Requests\RegisterV1Request;
use App\Interfaces\CmsRepositoryInterface;
use App\Interfaces\RecruiterRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\Industry;
use App\Models\Recruiter;
use Illuminate\Support\Facades\Session;


class RegisterController extends Controller
{
    protected $recruiterRepository = '';
    protected $cmsRepository = "";
    protected $industry = "";
    public function __construct(RecruiterRepositoryInterface $recruiterRepository, CmsRepositoryInterface $cmsRepository, Industry $industry)
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->cmsRepository = $cmsRepository;
        $this->industry = $industry;
    }

    public function loginV2()
    {
        if (Auth::guard('recruiter')->check()) {
            return redirect()->route('recruiter.dashboard');
        }
        return view('recruiter.login');
    }

    public function loginV2SaveOld(LoginV2Request $request)
    {
        $emailPassword = $request->only('email', 'password');
        $emailPassword['is_email_verified'] = Recruiter::IS_EMAIL_VERIFIED;
        if (Auth::guard('recruiter')->attempt($emailPassword)) {
            return $this->sendResponse(true, [], trans('messages.custom.login_messages'), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('messages.custom.invalid_credential'), $this->failedStatus);
    }

    public function loginV2Save(LoginV2Request $request)
    {
        $emailPassword = $request->only('email', 'password');
        $emailPassword['is_email_verified'] = Recruiter::IS_EMAIL_VERIFIED;
        if (Auth::guard('recruiter')->attempt($emailPassword)) {
            $user = Auth::guard('recruiter')->user();
            if ($user->status != 1) {
                // User is blocked, return blocked message
                return $this->sendResponse(false, [], trans('messages.custom.user_blocked_message'), $this->failedStatus);
            }
            // return redirect()->route('recruiter.dashboard');
            // User login successful
            return $this->sendResponse(true, [], trans('messages.custom.login_messages'), $this->successStatus);
        }
        // Invalid credentials
        return $this->sendResponse(false, [], trans('messages.custom.invalid_credential'), $this->failedStatus);
    }

    public function signUpV1(RegisterV1Request $request)
    {
        $request->session()->remove('register');
        $reqData = $request->all();
        $request->session()->put('register', $reqData);
        return $this->sendResponse(true, [], '', $this->successStatus);
    }

    public function index(Request $request)
    {
        $register = $request->session()->get('register');
        if (!empty($register)) {
            return view('auth.register-v1', compact('register'));
        }
        return view('auth.login');
    }

    public function signUpV2(Request $request)
    {
        $reqData = $request->all();
        $register = $request->session()->get('register');
        if (!empty($register)) {
            $register['password'] = Hash::make($reqData['password']);
            $request->session()->put('register', $register);
            return $this->sendResponse(true, [], '', $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('messages.custom.invalid_register'), $this->successStatus);
    }

    public function signUpV3View(Request $request)
    {
        $register = $request->session()->get('register');
        $getBusinessCmsData = $this->cmsRepository->getTermsCmsData('terms_and_conditions', 2);
        if (!empty($register)) {
            return view('auth.register-v2', compact('register', 'getBusinessCmsData'));
        }
        return view('auth.login');
    }
    public function signUp()
    {
        $industry = $this->industry->Getindustry();
        return view('auth.register', compact('industry'));
    }
    public function signUpV3(Request $request)
    {
        $register = $request->session()->get('register');
        if (!empty($register)) {
            $user = $this->recruiterRepository->store($register);
            if ($user) {
                $details = [
                    'title' => 'Job Matche - Email Verify',
                    'body' => 'Please verify email',
                    'name' => $register['business_name'],
                    'id' => $user->id
                ];
                Mail::to($register['email'])->send(new \App\Mail\EmailVerify($details));
            }
            $request->session()->remove('register');

            return $this->sendResponse(true, [], trans('messages.custom.email_verify'), $this->successStatus);
        }
        return $this->sendResponse(false, [], trans('messages.custom.invalid_register'), $this->successStatus);
    }

    public function verifyEmail($id)
    {
        $emailVerify = $this->recruiterRepository->emilVerify($id);
        if ($emailVerify) {
            session()->flash('success', trans('messages.custom.emailverified'));
            return redirect()->route('recruiter.login');
        } else {
            session()->flash('error', trans('messages.custom.error_messages'));
            redirect()->back();
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('success', trans('messages.custom.logout_messages'));
        return redirect()->route('login');
    }
}
