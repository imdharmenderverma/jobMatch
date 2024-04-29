<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Interfaces\FaqRepositoryInterface;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    protected $faqRepository = "";
    public function __construct(FaqRepositoryInterface $faqRepository)
    {
        $this->faqRepository = $faqRepository;
    }

    public function get(Request $request)
    {
        $faqData = $this->faqRepository->get($request->search);
        return $this->sendResponse(true, $faqData, trans(
            'validation.get_success'
        ), $this->successStatus);
    }
}
