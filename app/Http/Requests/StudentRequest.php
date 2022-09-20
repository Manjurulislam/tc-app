<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'exam'       => 'required',
            'year'       => 'required',
            'rollNo'     => 'required|integer|min:6',
            'regNo'      => 'required|integer|min:10',
            'centerName' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'exam.required'       => 'Exam is required',
            'year.required'       => 'Passing year is required',
            'rollNo.required'     => 'Roll is required',
            'regNo.required'      => 'Registration no is required',
            'centerName.required' => 'Center name & code is required',
        ];
    }
}
