<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AppUserVideoApiRequest extends FormRequest
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
            'skip'   =>  'required',
            'video'   =>  'max:48000',
        ];
    }

    public function messages()
    {
        $messages = array(
            'skip.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Skip"]
            ),
            'video.max' => trans(
                'validation.custom.file_size',
                ["attribute" => "Video", "size" => 46]
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
