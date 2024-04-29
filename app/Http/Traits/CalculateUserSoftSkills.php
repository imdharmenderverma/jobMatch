<?php

namespace App\Http\Traits;

use App\Models\Statement;
use App\Models\StatementSkill;
use App\Models\UserSoftSkill;
use App\Models\UserStatement;

trait CalculateUserSoftSkills
{
    public function saveUserSoftSkill($userId)
    {
        $statementIds = UserStatement::where(['user_id' => $userId])->pluck('statement_id')->toArray();
        $softSkillIds = Statement::whereIn('id', $statementIds)->pluck('statement_skill_id')->toArray();
        $sortArray =  array_count_values($softSkillIds);
        $statementSkill = StatementSkill::whereIn('id', array_keys($sortArray))->get()->keyBy('id')->toArray();
        $names = array();
        foreach ($sortArray as $key => $val) {
            $names[] = $val;
        }
        $arr = [];
        foreach ($sortArray as $key => $value) {
            $arr[] = ['statement_skill_id' => $key, 'total' => $value];
        }
        array_multisort($names, SORT_DESC, $arr);

        UserSoftSkill::where('user_id', $userId)->delete();
        foreach ($arr as $k => $v) {
            if ($k < 5) {
                $title = $statementSkill[$v['statement_skill_id']]['title'];
                UserSoftSkill::create(['user_id' => $userId, 'title' => $title, 'statement_skill_id' => $v['statement_skill_id']]);
            }
        }
    }
}
