<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class FcmTokenRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'fcm_token' => 'required',
            'type' => 'required',
        ];
    }



    protected function failedValidation(Validator $validator)
    {
        $response = response()->json(['error' => $validator->errors()], 422);
        throw new ValidationException($validator, $response);
    }
}
