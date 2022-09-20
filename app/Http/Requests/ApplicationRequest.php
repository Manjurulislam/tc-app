<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            'center_code'       => 'required',
            'religion'          => 'required',
            'institute'         => 'required',
            'present_address'   => 'required',
            'permanent_address' => 'required',
            'phone'             => 'required|unique:students',
            'sonali_sheba_no'   => 'required|unique:applications',
            'exams'             => 'required',
            'exams.*.id'        => 'required',
            'exams.*.roll'      => 'required',
            'exams.*.reg_no'    => 'required',
            'photo'             => 'required',
            'birthCert'         => 'required',
            'primaryCert'       => 'required',
            'testimonialCert'   => 'required',
            'nidCert'           => 'required',
            'afidCert'          => 'required',
            'nidGuardianCert'   => 'required',
        ];
    }
}
