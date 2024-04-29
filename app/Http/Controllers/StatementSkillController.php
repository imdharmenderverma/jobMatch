<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStatementSkillRequest;
use App\Interfaces\StatementSkillRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;

class StatementSkillController extends Controller
{
    protected $statementSkillRepository = "";
    public function __construct(StatementSkillRepositoryInterface $statementSkillRepository)
    {
        $this->statementSkillRepository = $statementSkillRepository;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->statementSkillRepository->get($request->search);
            return Datatables::of($data)
                ->addColumn('id', function(){
                    static  $id = 0;
                    return ++$id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<img src="'.asset('assets/img/editjob.png').'" data-id="'.$row->id.'" data-title="'.$row->title.'" class="jobEdit edit-statement-skill action-icon">';
                    $btn .= '<img src="'.asset('assets/img/deletejob.png').'" data-id="'.$row->id.'" class="jobDelete delete-statement-skill action-icon">';
                    return $btn;
                })
                ->rawColumns(['action', 'id'])
                ->make(true);
        }
        return view('admin.statement-skill.index');
    }

   
    public function store(StoreStatementSkillRequest $request)
    {
        try {
            $data = $this->statementSkillRepository->store($request->all());
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "Statement Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }


  
    public function update(Request $request, $id)
    {
        try {
            $isExists = $this->statementSkillRepository->getDataByColumn('id', $id);
            if ($isExists) {
                $data = $this->statementSkillRepository->update($id, $request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Statement Skill"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->failedStatus);
        }
    }

 
    public function destroy(string $id)
    {
        try {
            $this->statementSkillRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Statement Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }
}
