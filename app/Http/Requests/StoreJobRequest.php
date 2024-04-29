<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreJobRequest extends FormRequest
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
        $id = $this->request->get('id');
        return [
            // 'title' => ['required', Rule::unique('jobs', 'title')->whereNull('deleted_at')->ignore($id)],
            // 'role_name' => 'required',
            // 'company_name' => 'required',
            // 'location' => 'required',
            'start_date' => 'required',
            // 'type_of_work' => 'required',
            'industry' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'requirement' => 'required',
            'salary_range' => 'required',
            'skill_id' => 'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'title.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Title"]
            ),
            'title.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Title"]
            ),
            'role_name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Role"]
            ),
            'company_name.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Company name"]
            ),
            'location.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Location"]
            ),
            'start_date.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Start date"]
            ),
            'type_of_work.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Work"]
            ),
            'industry.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Industry"]
            ),
            'end_date.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "End date"]
            ),
            'description.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Description"]
            ),
            'requirement.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Requirements"]
            ),
            'salary_range.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Salary range"]
            ),
            'skill_id.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Skill"]
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
