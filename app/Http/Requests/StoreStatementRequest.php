<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StoreStatementRequest extends FormRequest
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
            'page_number' => 'required',
            'title' => ['required', Rule::unique('statements', 'title')->whereNull('deleted_at')->ignore($id)],
        ];
    }

    public function messages()
    {
        $messages = array(
            'title.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Title"]
            ),
            'page_number.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "page Number"]
            ),
            'title.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Title"]
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
