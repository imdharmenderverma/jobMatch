<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterV2Request extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'password' => ['required', 'min:6', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', 'confirmed'],
        ];
    }

    public function messages()
    {
        $messages = array(
            'password.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Password"]
            ),
            'password.min' => trans(
                'validation.min.numeric',
                ["attribute" => "Password"]
            ),
            'password.regex' => trans(
                'validation.password.regex',
                ["attribute" => "Password"]
            ),
            'password.confirmed' => trans(
                'validation.confirmed',
                ["attribute" => "Password"]
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
