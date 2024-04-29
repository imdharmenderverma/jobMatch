<?php

namespace App\Repositories;

use App\Interfaces\RecruiterRepositoryInterface;
use App\Models\PasswordResetTokens;
use App\Models\Recruiter;
use App\Models\ResumeBuilderSubscription;
use App\Models\UserPreviousExperience;
use Illuminate\Support\Facades\Auth;

class RecruiterRepository implements RecruiterRepositoryInterface
{
    const ACTIVE_STATUS = 1;
    const INACTIVE_STATUS = 0;

    public function store($request)
    {
        $user = Recruiter::create($request);
        return $user;
    }

    public function updateWithId($id, $data)
    {
        $userData = Recruiter::find($id)->update($data);
        return $userData;
    }

    public function delete($id)
    {
        return Recruiter::where('id', $id)->delete();
    }

    public function get($search = '', $filter = [], $location = '')
    {
        $query = Recruiter::with(['industry', 'job.matchUser'])->withCount(['job', 'activeJob']);
        if ($location != '') {
            $array = explode(" ", $location);
            $query = $query->where(function ($q) use ($array) {
                foreach ($array as $searchLocation) {
                    $q->orWhere('address', 'like', "%{$searchLocation}%");
                }
            });
        }
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%");
            });
        }
        if (count($filter) > 0) {
            if (isset($filter['industry']) && $filter['industry'] != null) {
                $query = $query->where('industry_id', $filter['industry']);
            }
            if (isset($filter['sort_by']) && $filter['sort_by'] == 1) {
                $query = $query->orderBy('business_name', 'asc')->orderBy('trading_name', 'asc');
            } else {
                $query = $query->orderBy('id', 'desc');
            }
        }

        // Join with industries table and order by title
        $query->leftJoin('industries', 'recruiters.industry_id', '=', 'industries.id')
            ->orderBy('industries.title', 'asc');

        $results = $query->get();

        // dd($results->pluck('industry.title'));

        return $results;
    }

    public function updateWithColumn($column, $value, $data)
    {
        $userData = Recruiter::where($column, $value)->update($data);
        return $userData;
    }

    public function checkEmail($request)
    {
        return Recruiter::where('email', $request->email)->first();
    }

    public function checkEmailToForgot($token, $email = '')
    {
        $data = PasswordResetTokens::where('token', $token);
        if ($email != '') {
            $data = $data->where('email', $email);
        }
        return $data->first();
    }

    public function forgotPassword($token, $email)
    {
        return PasswordResetTokens::updateOrCreate(['email' => $email], ['token' => $token]);
    }

    public function deleteForgotEmail($email)
    {
        return PasswordResetTokens::where(['email' => $email])->delete();
    }

    public function getDataByColumn($column, $value)
    {
        return Recruiter::where($column, $value)->first();
    }

    public function getData($request)
    {
        return ResumeBuilderSubscription::with('getUserEducation')->with('getUserStatementData')->with('getUserExperiences')->with('getAppUserData')->where('user_id', $request)->first();
    }

    public function geLastExperiences($request)
    {
        return UserPreviousExperience::where('user_id', $request)->latest()->first();
    }

    public function emilVerify($id)
    {
        return Recruiter::where('id', $id)->update(['is_email_verified' => '1']);
    }
}
