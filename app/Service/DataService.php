<?php

namespace App\Service;

class DataService
{

    public function transformApplication($application)
    {
        return [
            'id'            => data_get($application, 'id'),
            'name'          => data_get($application, 'student.name'),
            'father_name'   => data_get($application, 'student.father_name'),
            'mother_name'   => data_get($application, 'student.mother_name'),
            'phone'         => data_get($application, 'student.phone'),
            'roll_no'       => data_get($application, 'student.academicInfo.ssc_roll_no'),
            'reg_no'        => data_get($application, 'student.academicInfo.ssc_reg_no'),
            'pass_year'     => data_get($application, 'student.academicInfo.ssc_pass_year'),
            'cgpa'          => data_get($application, 'student.academicInfo.ssc_cgpa'),
            'is_file'       => data_get($application, 'student.academicInfo.attachment'),
            'current_col'   => [
                'eiin_no'     => data_get($application, 'student.academicInfo.eiin_no'),
                'name'        => data_get($application, 'student.academicInfo.college_name'),
                'group'       => data_get($application, 'student.academicInfo.group'),
                'class'       => data_get($application, 'student.academicInfo.class'),
                'roll_no'     => data_get($application, 'student.academicInfo.roll_no'),
                'session'     => data_get($application, 'student.academicInfo.session'),
                'district'    => data_get($application, 'student.academicInfo.district'),
                'upazila'     => data_get($application, 'student.academicInfo.upazila'),
                'post_office' => data_get($application, 'student.academicInfo.post_office'),
            ],
            'admission_col' => [
                'eiin_no'      => data_get($application, 'to_college_eiin'),
                'name'         => data_get($application, 'college_name'),
                'district'     => data_get($application, 'district'),
                'upazila'      => data_get($application, 'upazila'),
                'post_office'  => data_get($application, 'post_office'),
                'subject_comp' => data_get($application, 'student.academicInfo.subject_comp'),
                'subject_elec' => data_get($application, 'student.academicInfo.subject_elec'),
                'subject_optn' => data_get($application, 'student.academicInfo.subject_optn'),
            ],
            'approves'      => data_get($application, 'approves')
        ];

    }


}
