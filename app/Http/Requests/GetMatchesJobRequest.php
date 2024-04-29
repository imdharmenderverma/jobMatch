<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class GetMatchesJobRequest extends FormRequest
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
            // 'latitude'   =>  'required',
            // 'longitude'   =>  'required',
            // 'radius'   =>  'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'latitude.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Latitude"]
            ),
            'longitude.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Longitude"]
            ),
            'radius.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Radius"]
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
