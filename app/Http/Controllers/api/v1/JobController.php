<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetMatchesJobRequest;
use App\Http\Requests\JobCoverLetterRequest;
use App\Http\Requests\JobIdRequest;
use App\Http\Requests\JobResumeRequest;
use App\Http\Traits\ImageUploadTrait;
use App\Interfaces\AppUserRepositoryInterface;
use App\Interfaces\JobRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    use ImageUploadTrait;
    protected $jobRepository = "";
    protected $appUserRepository = "";
    public function __construct(JobRepositoryInterface $jobRepository, AppUserRepositoryInterface $appUserRepository)
    {
        $this->jobRepository = $jobRepository;
        $this->appUserRepository = $appUserRepository;
    }

    public function get()
    {
        $data = $this->jobRepository->getAllJob(1);
        foreach ($data as $key => $value) {
            $data[$key]->image = $value->image != null ? $this->getImageUrl($value->image) : null;
        }
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function getJobDetail(JobIdRequest $request)
    {
        $data = $this->jobRepository->getDataByColumn('id', $request->job_id);
        if ($data) {
            $data['image'] = $data->image != null ? $this->getImageUrl($data->image) : null;
            return $this->sendResponse(true, [$data], trans(
                'validation.get_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.invalid',
                ['attribute' => 'Job']
            ), $this->failedStatus);
        }
    }

    public function getApplyJob()
    {
        $data = $this->jobRepository->getApplyJob();
        foreach ($data as $key => $value) {
            $data[$key]->image = $value->image != null ? $this->getImageUrl($value->image) : null;
        }
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function getFavJob()
    {
        $data = $this->jobRepository->getFavJob();
        foreach ($data as $key => $value) {
            $data[$key]->image = $value->image != null ? $this->getImageUrl($value->image) : null;
        }
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function getMatchesJob(GetMatchesJobRequest $request)
    {
        $user = $this->appUserRepository->getSingalUserData('id', Auth::user()->id);
        if ($user->disable_job == 1) {
            return $this->sendResponse(false, [], trans(
                'validation.disable',
                ['attribute' => 'Jobs']
            ), $this->successStatus);
        }
        $data = $this->jobRepository->getMatchesJob($request->all());
        foreach ($data as $key => $value) {
            $data[$key]->image = $value->image != null ? $this->getImageUrl($value->image) : null;
        }
        return $this->sendResponse(true, $data, trans(
            'validation.get_success'
        ), $this->successStatus);
    }

    public function saveNotInterestedJob(JobIdRequest $request)
    {
        $job = $this->jobRepository->getDataByColumn('id', $request->job_id);
        if ($job) {
            $data = $this->jobRepository->saveNotInterestedJob($request->job_id);
            return $this->sendResponse(true, [$job], trans(
                'validation.create_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.invalid',
                ['attribute' => 'Job']
            ), $this->failedStatus);
        }
    }

    public function saveResume(JobResumeRequest $request)
    {
        if (Auth::user()) {
            $data = $this->jobRepository->saveResume($request->all());
            return $this->sendResponse(true, [$data], trans(
                'validation.create_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.invalid',
                ['attribute' => 'Job Resume']
            ), $this->failedStatus);
        }
    }

    public function saveCoverLetter(JobCoverLetterRequest $request)
    {
        if (Auth::user()) {
            $data = $this->jobRepository->saveCoverLetter($request->all());
            return $this->sendResponse(true, [$data], trans(
                'validation.create_success'
            ), $this->successStatus);
        } else {
            return $this->sendResponse(false, [], trans(
                'messages.custom.invalid',
                ['attribute' => 'Job Cover Letter']
            ), $this->failedStatus);
        }
    }
}
