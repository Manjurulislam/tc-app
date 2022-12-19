<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcademicInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'eiin_no', 'college_name',
        'group', 'class', 'roll_no', 'session',
        'district', 'upazila', 'post_office', 'subject_comp',
        'ssc_roll_no', 'ssc_reg_no', 'ssc_pass_year', 'attachment',
        'ssc_cgpa', 'ssc_bord', 'subject_elec', 'subject_optn'
    ];

    protected $casts = [
        'subject_comp' => 'array'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

}
