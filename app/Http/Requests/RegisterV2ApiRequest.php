<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class RegisterV2ApiRequest extends FormRequest
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
        $validation = [
            'first_name' => 'required|max:25|string',
            'last_name' => 'required|max:25|string',
            'gender' => 'required',
            'dob' => 'required',
        ];
        if (!empty($this->request->get('user_id'))) {
            $validation['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('app_users')->whereNull('deleted_at')->ignore($this->request->get('user_id')), Rule::unique('recruiters')->whereNull('deleted_at'), Rule::unique('users')->whereNull('deleted_at')->ignore($this->request->get('user_id'))];
        } else {
            $validation['email'] = ['required', 'string', 'email', 'max:255', Rule::unique('app_users')->whereNull('deleted_at'), Rule::unique('recruiters')->whereNull('deleted_at'), Rule::unique('users')->whereNull('deleted_at')];
            $validation['password'] = ['required', 'min:6', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/', 'confirmed'];
        }
        return $validation;
    }

    public function messages()
    {
        $messages = array(
            'first_name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "First name"]
            ),
            'first_name.string' => trans(
                'validation.string',
                ["attribute" => "First name"]
            ),
            'first_name.max' => trans(
                'validation.custom.max_25_validation',
                ["attribute" => "First name"]
            ),
            'last_name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Last name"]
            ),
            'last_name.string' => trans(
                'validation.string',
                ["attribute" => "Last name"]
            ),
            'last_name.max' => trans(
                'validation.custom.max_25_validation',
                ["attribute" => "Last name"]
            ),
            'gender.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Gender"]
            ),
            'profile_photo_path.required' => trans(
                'validation.custom.common_required_upload',
                ["attribute" => "Profile Photo"]
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
                'success' => false,
            ], 422)
        );
    }
}
