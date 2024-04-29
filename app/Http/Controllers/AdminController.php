<?php

namespace App\Http\Controllers;

use App\Interfaces\AppUserRepositoryInterface;
use App\Models\AppUser;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $appUser,$appUserRepository = "";
    public function __construct(AppUser $appUser,AppUserRepositoryInterface $appUserRepository)
    {
        $this->appUser = $appUser;
        $this->appUserRepository = $appUserRepository;
    }
    public function dashoard()
    {
        $data['getAppUserCount'] = $this->appUser->getAppUserCount();
        $getSalaryRange = $this->appUser->getSalaryRange();
        $salaryArray = $getSalaryRange->toArray();
        $salaryArray = array_map('intval', $salaryArray);
        $data['averageSalary'] = count($salaryArray) > 0 ? round(array_sum($salaryArray) / count($salaryArray), 2) : 0;
        $data['getAverageTimeFile'] = $this->appUser->getAverageTimeFile();
        $data['getSavedJob'] = round($this->appUser->getSavedJob(),2);
        $data['getNumberOfApplicantsJob'] = $this->appUser->getNumberOfApplicantsJob();
        $data['getPeopleMatched'] = $this->appUser->getPeopleMatched();
        $data['averageMaleCount'] = round($this->appUserRepository->totalUserCountByGender('male')*100/$data['getAppUserCount'],2);
        $data['averageFemaleCount'] = round($this->appUserRepository->totalUserCountByGender('female')*100/$data['getAppUserCount'],2);
        $data['totalAge'] = number_format($this->appUserRepository->totalAppUserAge()/$data['getAppUserCount'],0,'.','');
        return view('admin.dashboard', compact('data'));
    }

    public function userLocationAjaxDetail(Request $request){
        $type = $request->type;
        $data['actStateCount'] = $actStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'Australian Capital Territory');

        $data['qldStateCount'] = $qldStateCount =  $this->appUserRepository->stateCurrentWiseUserCount($type,'Queensland');

        $data['nswStateCount'] = $nswStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'New South Wales');

        $data['ntStateCount'] = $ntStateCount =  $this->appUserRepository->stateCurrentWiseUserCount($type,'Northern Territory');

        $data['saStateCount'] = $saStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'South Australia');

        $data['tasStateCount'] = $tasStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'Tasmania');

        $data['vicStateCount'] =  $vicStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'Victoria');

        $data['waStateCount'] = $waStateCount = $this->appUserRepository->stateCurrentWiseUserCount($type,'Western Australia');

        $data['totalCount'] = $actStateCount + $qldStateCount + $nswStateCount + $ntStateCount+ $saStateCount + $tasStateCount + $vicStateCount + $waStateCount;

        $data['actLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Australian Capital Territory');

        $data['qldLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Queensland');

        $data['nswLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'New South Wales');

        $data['ntLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Northern Territory');

        $data['saLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'South Australia');

        $data['tasLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Tasmania');

        $data['vicLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Victoria');

        $data['waLastStateCount'] = $this->appUserRepository->stateLastWiseUserCount($type,'Western Australia');

        return $this->sendResponse(true, $data, '', $this->successStatus);
    }

    public function getSalaryRange($type){
        $getSalaryRange = $this->appUser->getSalaryRangeNew($type);
        $salaryArray = $getSalaryRange->toArray();
        $salaryArray = array_map('intval', $salaryArray);
        $data['averageSalary'] = count($salaryArray) > 0 ? round(array_sum($salaryArray) / count($salaryArray), 2) : 0;
        return $this->sendResponse(true, $data, '', $this->successStatus);
    }
}
