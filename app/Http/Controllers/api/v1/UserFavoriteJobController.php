<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFavoriteJobApiRequest;
use App\Interfaces\JobRepositoryInterface;

class UserFavoriteJobController extends Controller
{

    protected $jobRepository = "";
    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(UserFavoriteJobApiRequest $request)
    {
        try {
            $job = $this->jobRepository->getDataByColumn('id', $request->job_id);
            if ($job) {
                $alreadyAppliedJob = $this->jobRepository->checkFavorite($request->job_id);
                
                if ($alreadyAppliedJob) {
                    $data = $this->jobRepository->deleteFavorite($request->job_id);
                    $msg = 'messages.custom.unfavorite';
                }else{
                    $data = $this->jobRepository->storeFavorite($request->job_id);
                    $msg = 'messages.custom.favorite';
                }
                return $this->sendResponse(true, [$job], trans(
                    $msg
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans(
                    'messages.custom.invalid', ['attribute' => 'Job']), $this->successStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }

}
