<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PendingDataExport implements FromArray, WithHeadings
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        return $this->data;
    }


    public function headings(): array
    {
        return [
            'SL',
            'Exam Name',
            'Pass Year',
            'Roll No',
            'Reg No',
            'Session',
            'Name of Examinee',
            'Error Name',
            'Error Father Name',
            'Error Mother Name',
            'Error Religion',
            'Error Gender',
            'Error Dob',
            'Sonali sheba no'
        ];
    }
}
