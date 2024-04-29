<?php

namespace App\Http\Controllers;

use App\Http\Requests\FaqRequest;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FaqController extends Controller
{
    protected $faqRepository = "";
    const FAQUSER = 1;
    const FAQBUSINESS = 2;
    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function index(Request $request)
    {

        $faqDetails = $this->faqRepository->get();
        $getUserFaqData = $faqDetails->where('faq_type', self::FAQUSER);
        $getBusinessFaqData = $this->faqRepository->getUserFaq();
        return view('admin.faq.index', compact('getUserFaqData', 'getBusinessFaqData'));
    }

    public function faqData(Request $request)
    {

        $userData = $this->faqRepository->getData($request->faq_type);

        return response()->json(['status' => 1, 'message', 'userData' => $userData]);
    }

    public function store(FaqRequest $request)
    {
        try {
            if ($request->faq_id != "") {
                $data = $this->faqRepository->update($request->faq_id, $request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.update_messages',
                    ["attribute" => "FAQ"]
                ), $this->successStatus);
            } else {
                $data = $this->faqRepository->store($request->all());
                return $this->sendResponse(true, $data, trans(
                    'messages.custom.create_messages',
                    ["attribute" => "FAQ"]
                ), $this->successStatus);
            }
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }

    public function faqIndexData(Request $request)
    {
        $getBusinessFaqData = $this->faqRepository->getUserFaq();

        return view('recruiter.faq.index', compact('getBusinessFaqData'));
    }


    public function destroy(string $id)
    {

        try {
            $this->faqRepository->delete($id);
            return $this->sendResponse(true, ['data' => []], trans(
                'messages.custom.delete_messages',
                ["attribute" => "FAQ"]
            ), $this->successStatus);
        } catch (\Exception $e) {
            return $this->sendResponse(false, [], trans(
                'messages.custom.error_messages'
            ), $this->errorStatus);
        }
    }
}
