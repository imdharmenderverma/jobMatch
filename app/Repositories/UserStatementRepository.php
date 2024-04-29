<?php

namespace App\Repositories;

use App\Http\Traits\CalculateUserSoftSkills;
use App\Interfaces\UserStatementRepositoryInterface;
use App\Models\StatementSkill;
use App\Models\UserStatement;
use App\Models\Statement;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;

class UserStatementRepository implements UserStatementRepositoryInterface
{
    use CalculateUserSoftSkills;

    public function get($category = '')
    {
        $userId = Auth::user()->id;
        $query =  UserStatement::with('statement')->where(['user_id' => $userId]);
        if ($category != '') {
            $query = $query->where(['category_id' => $category]);
        }
        $query = $query->get();
        foreach ($query as $key => $value) {
            $query[$key]->statement_title = $value->statement != null ? $value->statement->title : '';
        }
        return $query;
    }

    public function store($request)
    {
        $userId = Auth::user()->id;
        $category_id = $request['category_id'];
        $statements = explode(',', $request['statement_id']);
        $no = 5;
        UserStatement::where(['user_id' => $userId, 'category_id' => $category_id])->delete();
        foreach ($statements as $value) {
            $statementId =  Statement::where('id', $value)->first();
            $statementSkillId = StatementSkill::where('id', $statementId->statement_skill_id)->first();

            $create = [
                'user_id' => $userId,
                'category_id' => $category_id,
                'statement_id' => $value,
                'statement_skill_id' => $statementId->statement_skill_id,
                'skill_name' => $statementSkillId->title,
                'score_no' => $no,
            ];
            UserStatement::create($create);
            if ($no > 1) {
                $no--;
            }
        }
        if ($category_id == 5) {
            $this->saveUserSoftSkill($userId);
            Artisan::call('job:matching', ['--user_id' => $userId]);
        }
        return true;
    }
}
