<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\StatementRepositoryInterface;
use Illuminate\Http\Request;

class StatementController extends Controller
{
    protected $stamentRepository = "";
    public function __construct(StatementRepositoryInterface $stamentRepository)
    {
        $this->stamentRepository = $stamentRepository;
    }

    public function get(Request $request)
    {
        if ($request->category_id == 5) {
            $data = $this->stamentRepository->getScoreSkillList('', '5');
        } else {
            $data = $this->stamentRepository->get('', $request->all());
        }
        $finalData = [];
        foreach ($data as $key => $value) {
            $finalData[$key]['category'] = $key;
            $finalData[$key]['statements'] = $value;
        }
        return $this->sendResponse(true, array_values($finalData), trans(
            'validation.get_success'
        ), $this->successStatus);
    }
}
