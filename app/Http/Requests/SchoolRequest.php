<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SchoolRequest extends FormRequest
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
        return [
            'name' => 'sometimes|required|max:200|unique:schools,name,'.$this->id,
            'term_id' => 'sometimes|required',
            'grading_id' => 'sometimes|required',
            'class_id' => 'sometimes|required',
            'campus' => 'string|required',
            'address' => 'string|required',
            'shortcut' => 'string|required',
            'region_code' => 'required',
            'province_code' => 'required',
            'municipality_code' => 'required',
        ];
    }

    public function messages()
    {
        $message = [
            'region_code.required' => 'Region required.',
            'province_code.required' => 'Province required.',
            'municipality_code.required' => 'Municipality required.',
        ];
        return $message;
    }
}
