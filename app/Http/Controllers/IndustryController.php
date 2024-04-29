<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIndustryRequest;
use App\Interfaces\IndustryRepositoryInterface;
use Illuminate\Http\Request;
use DataTables;

class IndustryController extends Controller
{
    protected $industryRepository = "";
    public function __construct(IndustryRepositoryInterface $industryRepository)
    {
        $this->industryRepository = $industryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->industryRepository->get($request->search);
            return Datatables::of($data)
                ->addColumn('id', function(){
                    static  $id = 0;
                    return ++$id;
                })
                ->addColumn('action', function ($row) {
                    $btn = '<img src="'.asset('assets/img/editjob.png').'" data-id="'.$row->id.'" data-title="'.$row->title.'" data-parent="'.$row->parent_id.'" class="jobEdit edit-industry action-icon">';
                    $btn .= '<img src="'.asset('assets/img/deletejob.png').'" data-id="'.$row->id.'" class="jobDelete delete-industry action-icon">';
                    return $btn;
                })
                ->rawColumns(['action', 'id'])
                ->make(true);
        }
        $parentIndustry = $this->industryRepository->getParentIndustry();
        return view('admin.industry.index', compact('parentIndustry'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreIndustryRequest $request)
    {
        try {
            $data = $this->industryRepository->store($request->all());
            return $this->sendResponse(true, $data, trans(
                'messages.custom.create_messages',
                ["attribute" => "Industry"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(StoreIndustryRequest $request, $id)
    {
        try {
            $isExists = $this->industryRepository->getDataByColumn('id', $id);
            if ($isExists) {
                $data = $this->industryRepository->update($id, $request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "Industry"]
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
    public function destroy($id)
    {
        try {
            $this->industryRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "Industry"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->errorStatus);
        }
    }

    public function getChild(Request $request) {
        try {
            $data = $this->industryRepository->getChild($request->id);
            return $this->sendResponse(true, $data, trans('validation.get_success'), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'), $this->failedStatus);
        }
    }
}
