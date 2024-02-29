<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeDetails extends Model
{
    protected $fillable = [
        'district', 'thana', 'eiin', 'college_name',
        'shift', 'version', 'group_name', 'gender',
        'min_gpa', 'own_gpa', 'total_seats', 'sq_pct',
        'sq_num', 'reserve_ptc', 'reserve_num', 'sq_min_gpa',
        'college_receive', 'sub_reg', 'available_seats'
    ];
}
