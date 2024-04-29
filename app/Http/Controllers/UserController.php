<?php

namespace App\Http\Controllers;

use App\Interfaces\IndustryRepositoryInterface;
use App\Interfaces\RecruiterRepositoryInterface;
use App\Interfaces\AppUserRepositoryInterface;
use App\Models\AppUser;
use App\Models\ResumeBuilderSubscription;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Redirect;
use PDF;

class UserController extends Controller
{
    protected $userRepository = "";
    protected $industryRepository = "";
    protected $appUserRepository = "";
    public function __construct(RecruiterRepositoryInterface $userRepository, AppUserRepositoryInterface $appUserRepository, IndustryRepositoryInterface $industryRepository)
    {
        $this->userRepository = $userRepository;
        $this->appUserRepository = $appUserRepository;
        $this->industryRepository = $industryRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->userRepository->get($request->search, ['industry' => $request->industry, 'sort_by' => $request->sort_by], $request->location);
            return Datatables::of($data)
                ->addColumn('id', function () {
                    static  $id = 0;
                    return ++$id;
                })->addColumn('action', function ($row) {
                    $btn = '<div class="dropdown">
                    <button class="dropbtn action-btn-icon" data-id="' . $row->id . '">
                    <img src="../assets/img/dots.svg" style="width: 20px;">
                </button>
                    <div id="myDropdown' . $row->id . '" class="dropdown-content myDropdown edit-dlt-drop">
                    <a href="javascript:void(0)" data-id="' . $row->id . '" class="delete-user" style="text-align: left;"><img src="' . asset('assets/img/deletejob.png') . '" alt="" width=15">Delete</a>
                    </div>
                </div>';
                    return $btn;
                })->addColumn('location', function ($row) {
                    return $row->address_state;
                })->addColumn('industry_name', function ($row) {
                    return $row->industry != null ? $row->industry->title : '';
                })->addColumn('total_job_count', function ($row) {
                    return $row->job_count;
                })->addColumn('total_active_job_count', function ($row) {
                    return $row->active_job_count;
                })->addColumn('matches_count', function ($row) {
                    $count = 0;
                    foreach ($row->job as $value) {
                        $count += count($value->matchUser);
                    }
                    return $count;
                })->addColumn('status', function ($row) {
                    $checked = $row->status == 1 ? 'checked' : '';
                    return '<label class="switch">
                        <input type="checkbox" class="recruiter-status" ' . $checked . ' data-id="' . $row->id . '" data-val="' . $row->status . '">
                        <span class="slider round"></span>
                    </label>';
                })
                ->rawColumns(['id', 'action', 'location', 'industry_name', 'total_job_count', 'total_active_job_count', 'matches_count', 'status'])
                ->make(true);
        }
        $industries = $this->industryRepository->get();
        return view('admin.recruiter_user.index', compact('industries'));
    }

    public function updateStatus(Request $request)
    {
        try {
            $isExists = $this->userRepository->getDataByColumn('id', $request->id);
            if ($isExists) {
                $data = $this->userRepository->updateWithId($isExists->id, ['status' => $request->status]);
                $message = ($request->status == 1) ? trans('messages.custom.blocked_message') : trans('messages.custom.unblocked_message');
                return $this->sendResponse(true, $data, $message, $this->successStatus);
            } else {
                return $this->sendResponse(false, [], trans('validation.no_data_found_error'), $this->failedStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans('messages.custom.error_messages'), $this->failedStatus);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $this->userRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "User"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function ashleyMinkResumePDF()
    {
        ini_set('max_execution_time', 300);

        $pdf = PDF::loadView('pdf.resume', []);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
        return view('pdf.resume');
    }

    public function michelleBelleResumePDF()
    {
        ini_set('max_execution_time', 300);

        $pdf = PDF::loadView('pdf.resume_1', []);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
        return view('pdf.resume_1');
    }

    public function michelleDOEResumePDF()
    {
        ini_set('max_execution_time', 300);

        $pdf = PDF::loadView('pdf.resume_2', []);
        $pdf->setPaper('A4', 'portrait');

        return $pdf->stream();
        return view('pdf.resume_2');
    }

    public function getData(Request $request)
    {
        //templary commented
        $user = '298';
     
        $userData = $this->userRepository->getData($user);
        $lastExperience = $this->userRepository->geLastExperiences($user);

        if ($userData instanceof ResumeBuilderSubscription) {
            $userData = $userData->toArray();
        }
        // $htmlContent = view('pdf.resume', ['userData' => $userData])->render();
        // return response($htmlContent);

        $pdf = PDF::loadView('pdf.resume_1', ['userData' => $userData,'lastExperience' => $lastExperience]);
        return $pdf->download('sample.pdf');
    }

    // public function getData(Request $request)
    // {
    //     //templary commented
    //     // $user = '298';
    //     // dd("sda");
    //     // $htmlContent = view('pdf.resume_1')->render();

    //     // $userData = $this->userRepository->getData($user);

    //     // if ($userData instanceof ResumeBuilderSubscription) {
    //     //     $userData = $userData->toArray();
    //     // }
    //     // $htmlContent = view('pdf.resume_1', ['userData' => $userData])->render();
    //     // return response($htmlContent);

    //     $pdf = PDF::loadView('pdf.resume');
    //     // $pdf = PDF::loadView('pdf.resume_1', ['userData' => $userData]);
    //     return $pdf->download('sample.pdf');
    //     // return $pdf->download('sample.pdf');
    // }
}
