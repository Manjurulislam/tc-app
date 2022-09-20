<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id', 'exam_id', 'eiin_no',
        'roll_no', 'reg_no', 'passing_year',
        'session', 'center',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

}
