<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatementRequest;
use App\Interfaces\StatementRepositoryInterface;
use App\Interfaces\StatementSkillRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;

class StatementController extends Controller
{
    protected $stamentRepository = "";
    protected $statementSkillRepository = "";
    public function __construct(StatementRepositoryInterface $stamentRepository, StatementSkillRepositoryInterface $statementSkillRepository)
    {
        $this->stamentRepository = $stamentRepository;
        $this->statementSkillRepository = $statementSkillRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->stamentRepository->get($request->search);

            return Datatables::of($data)
                ->addColumn('id', function(){
                    static  $id = 0;
                    return ++$id;
                })
                ->addColumn('title', function($row){
                    return $row->title;
                })
                ->addColumn('category', function($row){
                    return $row->category_id;
                })
                ->addColumn('soft_skill_type', function ($row) {
                    $type = '';
                    if ($row->soft_skill_type == 1) {
                        $type = 'PROFESSIONAL';
                    } else if ($row->soft_skill_type == 2) {
                        $type = 'Lifestyle';
                    }
                    return $type;
                }) 

                ->addColumn('statement_skill_id', function ($row) {
                    foreach($row->statementSkill as $value){
                        return $value->title;
                    }
                }) 

                ->addColumn('action', function ($row) {
                    
                    $btn = '<div class="img-div"><img src="'.asset('assets/img/editjob.png').'" data-skill="'.$row->soft_skill_type.'" data-id="'.$row->id.'"  data-title="'.$row->title.'" data-page="'.$row->page_number.'" data-statement="'.$row->statement_skill_id.'" class="jobDelete edit-statement action-icon">';
                    $btn .= '<img src="'.asset('assets/img/deletejob.png').'" data-id="'.$row->id.'" class="jobDelete delete-statement action-icon"></div>';
                    return $btn;
                })
                ->rawColumns(['id', 'title','category','action'])
                ->make(true);
        }
        $statementSkill = $this->statementSkillRepository->get();

        return view('admin.statement.index',compact('statementSkill'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStatementRequest $request)
    {
        try {
            $data = $this->stamentRepository->store($request->all());
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "Statement"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $isExists = $this->stamentRepository->getDataByColumn('id', $id);
            if ($isExists) {
                $data = $this->stamentRepository->update($id, $request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Statement"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->failedStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->stamentRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
}
