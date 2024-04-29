<?php

namespace App\Http\Controllers;

use App\Http\Requests\HelpRequest;
use App\Interfaces\InboxRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class InboxController extends Controller
{
    protected $inboxRepository = "";
    public function __construct(InboxRepositoryInterface $inboxRepository)
    {
        $this->inboxRepository = $inboxRepository;
    }
    public function index(Request $request)
    {
        $data = $this->inboxRepository->get($request->search);
        $getHelp = $this->inboxRepository->getHelp($request->search);



        return view('admin.inbox.index', compact('data', 'getHelp'));
    }

    public function userData(Request $request)
    {
        if ($request->user_id) {
            $userData = $this->inboxRepository->getDataByColumn($request->user_id);
            $userData->date = Carbon::parse($userData->created_at)->format('d-m-Y');
        } else {
            $userData = $this->inboxRepository->getHelpUser($request->help_id);
            $userData->date = Carbon::parse($userData->created_at)->format('d-m-Y');
        }
        return response()->json(['status' => 1, 'message', 'userData' => $userData]);
    }


    public function addInbox(Request $request)
    {
        return view('recruiter.inbox.index');
    }


    public function storeData(HelpRequest $request)
    {
        try {
            $request->merge(['recruiter_id' => Auth::guard('recruiter')->user()->id]);
            $data = $this->inboxRepository->store($request->all());
            return $this->sendResponse(true, $data, trans(
                'messages.custom.question_messages',
                ["attribute" => "FAQ"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function flagUpdate(Request $request)
    {
        if ($request->id) {
            $flagUpdate = $this->inboxRepository->update($request->id);
        } else {
            $flagUpdate = $this->inboxRepository->updateHelp($request->helpsUserId);
        }
        return response()->json([
            'message' => trans('messages.custom.mark_as_read'),
            'data' => $flagUpdate,
        ], 200);
    }
}
