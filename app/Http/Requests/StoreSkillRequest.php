<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreSkillRequest extends FormRequest
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
        $parentId = $this->request->get('parent_id');
        if ($parentId == null) {
            return [
                'industry_id' => 'required',
                'title' => ['required', Rule::unique('skills', 'title')->whereNull('deleted_at')->ignore($id)],
            ];
        }else{
            return [
                'industry_id' => 'required',
                'title' => ['required', Rule::unique('skills', 'title')->whereNull('deleted_at')->ignore($id)],
            ];
        }
       
    }

    public function messages()
    {
        $messages = array(
            'title.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Sub-skill Name"]
            ),
            'title.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Sub-skill"]
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
