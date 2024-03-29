<?php

namespace App\Service;

use App\Models\Application;

class DataService
{
    public function transformApplication($application): array
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

    public function transformApplicationList($applications)
    {
        $applications->getCollection()->transform(function ($item) {

            $userRole      = data_get(auth()->user(), 'user_role');
            $appStatus     = data_get($item, 'status');
            $paymentStatus = data_get($item, 'payment_status');
            $approveApp    = $item->approves->first();
            $authUserId    = data_get(auth()->user(), 'id');

            //==============
            $isApproved = $item->approves()->where(['user_id' => $authUserId, 'application_id' => data_get($item, 'id')])
                ->where('is_approved', 0)->exists();

            $isRevert = $item->approves()->where(['application_id' => data_get($item, 'id'), 'is_revert' => 1])->exists();

            $item->id                = data_get($item, 'id');
            $item->application_id    = data_get($approveApp, 'application_id');
            $item->name              = data_get($item, 'student.name');
            $item->father_name       = data_get($item, 'student.father_name');
            $item->mother_name       = data_get($item, 'student.mother_name');
            $item->phone             = data_get($item, 'student.phone');
            $item->current_college   = data_get($item, 'student.academicInfo.college_name') . '-' . (data_get($item, 'student.academicInfo.eiin_no'));
            $item->admission_college = data_get($item, 'college_name') . '-' . data_get($item, 'to_college_eiin', '');
            $item->ssc_roll_no       = data_get($item, 'student.academicInfo.ssc_roll_no', '');
            $item->ssc_reg_no        = data_get($item, 'student.academicInfo.ssc_reg_no', '');
            $item->group             = data_get($item, 'student.academicInfo.group', '');
            $item->subject_comp      = data_get($item, 'student.academicInfo.subject_comp', '');
            $item->subject_elec      = data_get($item, 'student.academicInfo.subject_elec', '');
            $item->subject_optn      = data_get($item, 'student.academicInfo.subject_optn', '');
            $item->sharok_no         = data_get($item, 'sharok_no', '');
            $item->approved          = data_get($item, 'is_approved', '');
            $item->payment_status    = $paymentStatus;
            $item->status            = Application::$status[$appStatus];
            $item->userRole          = $userRole;
            $item->btnUpDown         = $isRevert;

            if (($userRole == 2) && !$paymentStatus) {
                $item->showApproveBtn = $isApproved;
            } elseif (($userRole != 2) && $paymentStatus) {
                if ($userRole == 3 && $isRevert) {
                    $item->showApproveBtn = $isRevert;
                } else {
                    $item->showApproveBtn = $isApproved;
                }
            }
            return $item;
        });
        return $applications;
    }


    public function transformApproveList($applications)
    {

        $applications->getCollection()->transform(function ($item) {
            $appStatus     = data_get($item, 'status');
            $paymentStatus = data_get($item, 'payment_status');

            $item->id                = data_get($item, 'id');
            $item->name              = data_get($item, 'student.name');
            $item->father_name       = data_get($item, 'student.father_name');
            $item->mother_name       = data_get($item, 'student.mother_name');
            $item->phone             = data_get($item, 'student.phone');
            $item->current_college   = data_get($item, 'student.academicInfo.college_name') . '-' . (data_get($item, 'student.academicInfo.eiin_no'));
            $item->admission_college = data_get($item, 'college_name') . '-' . data_get($item, 'to_college_eiin', '');
            $item->ssc_roll_no       = data_get($item, 'student.academicInfo.ssc_roll_no', '');
            $item->ssc_reg_no        = data_get($item, 'student.academicInfo.ssc_reg_no', '');
            $item->group             = data_get($item, 'student.academicInfo.group', '');
            $item->subject_comp      = data_get($item, 'student.academicInfo.subject_comp', '');
            $item->subject_elec      = data_get($item, 'student.academicInfo.subject_elec', '');
            $item->subject_optn      = data_get($item, 'student.academicInfo.subject_optn', '');
            $item->sharok_no         = data_get($item, 'sharok_no', '');
            $item->approved          = data_get($item, 'is_approved', '');
            $item->payment_status    = $paymentStatus;
            $item->status            = Application::$status[$appStatus];
            return $item;
        });
        return $applications;
    }


}
