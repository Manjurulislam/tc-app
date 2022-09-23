<?php

namespace App\Models;

use App\Enum\ApplicationStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'eiin_no', 'detail_id', 'college_code',
        'college_name', 'post_office', 'district', 'upazila',
        'sonali_sheba_no', 'sonali_sheba_branch',
        'payment_date', 'payment_status', 'applied_at', 'status'
    ];

    public static $status = [
        ApplicationStatus::PENDING   => 'PENDING',
        ApplicationStatus::LITERALLY => 'LITERALLY CORRECTION',
        ApplicationStatus::MEETING   => 'MEETING',
        ApplicationStatus::APPROVED  => 'APPROVED',
        ApplicationStatus::INVALID   => 'INVALID',
    ];

    protected $dates = [
        'created_at', 'app_date'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function scopePending($query)
    {
        $query->where('status', ApplicationStatus::PENDING);
    }

    public function scopeCorrection($query)
    {
        $query->where('status', ApplicationStatus::LITERALLY);
    }

    public function scopeApprove($query)
    {
        $query->where('status', ApplicationStatus::APPROVED);
    }


}
