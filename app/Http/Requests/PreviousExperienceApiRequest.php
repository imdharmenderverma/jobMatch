<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PreviousExperienceApiRequest extends FormRequest
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
            'company' => 'required',
            'industry' => 'required',
            'title' => 'required',
            'job_duties' => 'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'company.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Company"]
            ),
            'industry.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Industry"]
            ),
            'title.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Title"]
            ),
            'job_duties.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Job Duties"]
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
