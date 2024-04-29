<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AboutUsApiRequest extends FormRequest
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
            'location' => 'required',
            'location_range' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'min_income_expected' => 'required',
            'max_income_expected' => 'required',
            'industry' => 'required',
            'work_type' => 'required',
            'work_preference' => 'required',
        ];
    }

    public function messages()
    {
        $messages = array(
            'location.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Location"]
            ),
            'location_range.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Location Range"]
            ),
            'latitude.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Latitude"]
            ),
            'longitude.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Longitude"]
            ),
            'min_income_expected.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Min Income Expected"]
            ),
            'max_income_expected.required' => trans(
                'validation.custom.common_required',
                ["attribute" => "Max Income Expected"]
            ),
            'industry.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Industry"]
            ),
            'work_type.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Type Of Work"]
            ),
            'work_preference.required' => trans(
                'validation.custom.common_required_select',
                ["attribute" => "Work Preference"]
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
