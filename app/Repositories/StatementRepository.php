<?php

namespace App\Repositories;

use App\Interfaces\StatementRepositoryInterface;
use App\Models\Statement;
use App\Models\UserStatement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatementRepository implements StatementRepositoryInterface
{
    public function store($request)
    {
        $user = Statement::create($request);
        return $user;
    }
    public function getScoreSkillList($search = '', $request = [])
    {
        $userId = Auth::user()->id;
        $query = UserStatement::where('user_id', $userId)
            ->with('statement')
            ->groupBy('statement_skill_id')
            ->select('statement_skill_id', DB::raw('SUM(score_no) as total_score'))
            ->orderBy('total_score', 'desc')

            ->take(5)->get();

        foreach ($query as $value) {
            $statmentGet = Statement::with('statementSkill')->where('statement_skill_id', $value->statement_skill_id)->where('page_number', '5')->first();
            if ($statmentGet) {
                $statmentGet->total_score = $value->total_score;
                $statmentGets[] = $statmentGet->toArray();
            }
        }

        usort($statmentGets, function ($a, $b) {
            if ($a['total_score'] == $b['total_score']) {
                return strcmp($a['statement_skill'][0]['title'], $b['statement_skill'][0]['title']);
            }
            return $b['total_score'] - $a['total_score'];
        });

        return $statmentGets;
    }

    public function get($search = '', $request = [])
    {
        $query = Statement::with('statementSkill')->whereNull('deleted_at');
        if ($search != '') {
            $query = $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhereHas('statementSkill', function ($q) use ($search) {
                        $q->where('title', 'like', "%{$search}%");
                    });
            });
        }
        if (isset($request['page_number'])) {
            $query = $query->where('page_number', $request['page_number']);
        }
        if (isset($request['category_id'])) {
            $query = $query->where('page_number', $request['category_id']);
        }
        return $query->get();
    }
    public function getDataByColumn($column, $value)
    {
        return Statement::where($column, $value)->first();
    }
    public function update($id, $request)
    {
        return Statement::find($id)->update($request);
    }

    public function delete($id)
    {
        return Statement::find($id)->delete();
    }
}
