<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class FaqRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $id = $this->request->get('id');
        return [
            'question' => 'required',
            'answer'            =>  'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'question.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Question"]
            ),
            'question.unique' => trans(
                'validation.custom.common_exists',
                ["attribute" => "Question"]
            ),
            'answer.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Answer"]
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
