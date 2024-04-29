<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class RegisterV1Request extends FormRequest
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
            'business_name' => 'required|max:25|string',
            'trading_name' => 'required|max:25|string',
            'abn' => 'required',
            'website' => 'required',
            'industry_id' => 'required',
            'address' => 'required',
            'email' => ['required', 'string', 'email', 'max:255',Rule::unique('users')->whereNull('deleted_at'),Rule::unique('recruiters')->whereNull('deleted_at') ],
            'phone_number' => ['required', 'numeric', 'digits:10', Rule::unique('users')->whereNull('deleted_at'), Rule::unique('recruiters')->whereNull('deleted_at')],
        ];
    }

    public function messages()
    {
        $messages = array(
            'name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Name"]
            ),
            'industry_id.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Industry"]
            ),
            'address.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Address"]
            ),
            'name.string' => trans(
                'validation.string',
                ["attribute" => "Name"]
            ),
            'name.max' => trans(
                'validation.custom.max_25_validation',
                ["attribute" => "Name"]
            ),
            'email.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Email"]
            ),
            'email.email' => trans(
                'validation.email',
                ["attribute" => "Email"]
            ),
            'email.exists' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Email"]
            ),
            'email.max' => trans(
                'validation.custom.max_validation',
                ["attribute" => "Email"]
            ),
            'email.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Email"]
            ),
            'phone_number.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Phone number"]
            ),
            'phone_number.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Phone number"]
            ),
            'phone_number.numeric' => trans(
                'validation.numeric',
                ["attribute" => "Phone number"]
            ),
            'phone_number.digits' => trans(
                'validation.digits',
                ["attribute" => "Phone number", "digits" => 10]
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
