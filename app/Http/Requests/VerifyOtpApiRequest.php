<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VerifyOtpApiRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => 'required',
            'otp'=>'required|numeric|digits:4',
        ];
    }

    public function messages()
    {
        $messages = array(
            'otp.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Otp"]
            ),
            'otp.numeric' => trans(
                'validation.numeric',
                ["attribute" => "Otp"]
            ),
            'otp.digits' => trans(
                'validation.digits',
                ["attribute" => "Otp", "digits" => 4]
            ),
        );
        return $messages;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => $validator->errors()->all()[0],
                'success' => false
            ], 422)
        );
    }
}
