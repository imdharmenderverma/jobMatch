<?php

namespace App\Repositories;

use App\Interfaces\UserPortfolioRepositoryInterface;
use App\Models\UserPortfolio;
use Illuminate\Support\Facades\Auth;

class UserPortfolioRepository implements UserPortfolioRepositoryInterface
{
    public function store($experienceId, $request)
    {
        $userId = Auth::user()->id;
        foreach ($request as $value) {
            $value['user_id'] = $userId;
            $value['experience_id'] = $experienceId;
            UserPortfolio::create($value);
        }
        return true;
    }

    public function delete($id)
    {
        return UserPortfolio::find($id)->delete();
    }
    
    public function getById($id)
    {
        return UserPortfolio::find($id);
    }
}
