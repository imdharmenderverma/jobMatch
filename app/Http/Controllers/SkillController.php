<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSkillRequest;
use App\Interfaces\IndustryRepositoryInterface;
use App\Interfaces\SkillRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;

class SkillController extends Controller
{
    protected $skillRepository = "";
    protected $industryRepository = "";
    public function __construct(SkillRepositoryInterface $skillRepository, IndustryRepositoryInterface $industryRepository)
    {
        $this->skillRepository = $skillRepository;
        $this->industryRepository = $industryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->skillRepository->get($request->search);
            return Datatables::of($data)
                ->addColumn('id', function () {
                    static  $id = 0;
                    return ++$id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<img src="' . asset('assets/img/editjob.png') . '" data-id="' . $row->id . '" data-title="' . $row->title . '" data-parent="0,' . $row->industry_id . '" class="jobEdit edit-skill action-icon">';
                    $btn .= '<img src="' . asset('assets/img/deletejob.png') . '" data-id="' . $row->id . '" class="jobDelete delete-skill action-icon">';
                    return $btn;
                })
                ->rawColumns(['action', 'id'])
                ->make(true);
        }
        $industries = $this->industryRepository->getParentChild();
        return view('admin.skill.index', compact('industries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSkillRequest $request)
    {
        try {
            $data = $this->skillRepository->store($request->all());
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreSkillRequest $request, $id)
    {
        try {
            $isExists = $this->skillRepository->getDataByColumn('id', $id);
            if ($isExists) {
                $data = $this->skillRepository->update($id, $request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Skill"]
                ), $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->skillRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Skill"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function getSkill(Request $request)
    {
        try {
            $data = $this->skillRepository->getSkillIndustry($request->id);
            return $this->sendResponse(true, $data, trans('validation.get_success'), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->failedStatus);
        }
    }
}
