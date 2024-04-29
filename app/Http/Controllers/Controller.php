<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $successStatus = 200;
    protected $insertStatus = 201;
    protected $validationStatus = 400;
    protected $errorStatus = 500;
    protected $unauthorizedStatus = 401;
    protected $notFoundStatus = 404;
    protected $failedStatus = 451;

    public function sendResponse($success, $result, $message, $statusCode = 200)
    {
        $response = [
            'success' => $success,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, $statusCode);
    }
}
