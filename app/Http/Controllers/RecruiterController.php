<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\ForgotPasswordRecruiterRequest;
use App\Http\Requests\ResetPasswordRecruiterRequest;
use App\Interfaces\JobRepositoryInterface;
use App\Interfaces\RecruiterRepositoryInterface;
use App\Mail\ForgotRecruiterMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RecruiterController extends Controller
{
    protected $recruiterRepository = '';
    protected $jobRepository = '';
    public function __construct(RecruiterRepositoryInterface $recruiterRepository, JobRepositoryInterface $jobRepository)
    {
        $this->recruiterRepository = $recruiterRepository;
        $this->jobRepository = $jobRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function dashoard()
    {
        $data = [];
        $recruiterId = Auth::guard('recruiter')->user()->id;
        $data['jobs'] = $this->jobRepository->getActiveJob()->toArray();
        $data['total_matched_users'] =  array_reduce($data['jobs']['data'], function ($job, $user) {
            return $job + $user['match_user_count'];
        }, 0);
        $data['average_time_jobs_vacant'] = $this->jobRepository->calculateAverageVacancyTime($recruiterId);
        foreach ($data['jobs']['data'] as $key => $value) {
            $data['jobs']['data'][$key]['role_name'] = strlen($value['role_name']) > 20 ? substr($value['role_name'], 0, 20) . '...Read More' : $value['role_name'];

            $data['jobs']['data'][$key]['location'] = strlen($value['location']) > 20 ? substr($value['location'], 0, 20) . '...<a href="javascript:void(0);" class="text-success showMessageFullContent" data-message="' . $value['location'] . '"   data-name="Address"  >Read More</a>' : $value['location'];

            $skills = '';
            foreach ($value['skill'] as $v) {
                $skills .= $v['title'] . ', ';
            }
            $jobs[$key]['skill_name'] = rtrim($skills, ', ');
        }
        return view('recruiter.dashboard', compact('data'));
    }

    public function jobPost()
    {
        $jobs = $this->jobRepository->getActiveJob();
        foreach ($jobs as $key => $value) {
            $jobs[$key]['role_name'] = strlen($value['role_name']) > 20 ? substr($value['role_name'], 0, 20) . '...Read More' : $value['role_name'];

            $jobs[$key]['location'] = strlen($value['location']) > 20 ? substr($value['location'], 0, 20) . '...<a href="javascript:void(0);" class="text-success showMessageFullContent" data-message="' . $value['location'] . '"   data-name="Address"  >Read More</a>' : $value['location'];
            $skills = '';
            foreach ($value['skill'] as $v) {
                $skills .= $v['title'] . ', ';
            }
            $jobs[$key]['skill_name'] = rtrim($skills, ', ');
        }
        return view('recruiter.job-index', compact('jobs'));
    }

    public function jobListingAjax(Request $request)
    {
        if ($request->ajax()) {
            $jobs = $this->jobRepository->getActiveJob();
            foreach ($jobs as $key => $value) {
                $jobs[$key]['role_name'] = strlen($value['role_name']) > 20 ? substr($value['role_name'], 0, 20) . '...Read More' : $value['role_name'];
                $jobs[$key]['location'] = strlen($value['location']) > 20 ? substr($value['location'], 0, 20) . '...<a href="javascript:void(0);" class="text-success showMessageFullContent" data-message="' . $value['location'] . '"   data-name="Address"  >Read More</a>' : $value['location'];
                $skills = '';
                foreach ($value['skill'] as $v) {
                    $skills .= $v['title'] . ', ';
                }
                $jobs[$key]['skill_name'] = rtrim($skills, ', ');
            }
            return view('recruiter.job-pagination-index', compact('jobs'))->render();
        }
    }

    public function forgotPassword()
    {
        return view('recruiter.forgot-password');
    }

    public function storeForgotPassword(ForgotPasswordRecruiterRequest $request)
    {
        $checkEmail = $this->recruiterRepository->checkEmail($request);
        if ($checkEmail) {
            $token = Str::random(64);
            $checkEmail = $this->recruiterRepository->forgotPassword($token, $request->email);

            $data = [
                'url' => route('recruiter.reset-password', $token)
            ];
            try {
                Mail::to($request->email)->send(new ForgotRecruiterMail($data));
            } catch (\Exception $e) {
                Log::error("Email not sent from the Emails. Returned with error: " . $e->getMessage());
            }
            return $this->sendResponse(true, [], trans('messages.custom.emailSuccess'), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans('messages.custom.notEmail'), $this->failedStatus);
        }
    }

    public function resetPassword($token)
    {
        $data = $this->recruiterRepository->checkEmailToForgot($token);
        if ($data) {
            return view('recruiter.reset-password', compact('data'));
        }
        Session::flash('error', trans('messages.custom.invalid_token'));
        return redirect()->route('recruiter.login');
    }


    public function storeResetPassword(Request $request)
    {
        $checkToken = $this->recruiterRepository->checkEmailToForgot($request->token, $request->email);
        if ($checkToken) {
            $this->recruiterRepository->updateWithColumn('email', $request->email, ['password' => Hash::make($request->password)]);
            $this->recruiterRepository->deleteForgotEmail($request->email);
            return $this->sendResponse(true, [], trans('messages.custom.reset_messages', ['attribute' => 'Password']), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans('messages.custom.invalid_token'), $this->failedStatus);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('recruiter')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
        Session::flash('success', trans('messages.custom.logout_messages'));
        return redirect()->route('home');
    }
}
