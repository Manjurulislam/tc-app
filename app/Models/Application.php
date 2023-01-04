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
        'student_id', 'from_college_eiin', 'detail_id', 'college_code',
        'college_name', 'post_office', 'district', 'upazila',
        'sonali_sheba_no', 'to_college_eiin', 'sharok_no',
        'payment_date', 'payment_status', 'applied_at', 'status'
    ];

    public static $status = [
        ApplicationStatus::PENDING  => 'PENDING',
        ApplicationStatus::APPROVED => 'APPROVED',
    ];

    protected $dates = [
        'created_at', 'applied_at'
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function scopePending($query)
    {
        $userRole = data_get(auth()->user(), 'user_role');
        $eiinNo   = data_get(auth()->user(), 'eiin_no');

        if ($userRole != 3 && $userRole != 4) {
            $query->where('status', ApplicationStatus::PENDING)->where('from_college_eiin', $eiinNo)->orWhere('to_college_eiin');
        } else {
            $query->where('status', ApplicationStatus::PENDING);
        }
    }

    public function scopeApprove($query)
    {
        $userRole = data_get(auth()->user(), 'user_role');
        $eiinNo   = data_get(auth()->user(), 'eiin_no');

        if ($userRole != 3 && $userRole != 4) {
            $query->where('status', ApplicationStatus::APPROVED)->where('from_college_eiin', $eiinNo)->orWhere('to_college_eiin');
        } else {
            $query->where('status', ApplicationStatus::APPROVED);
        }
    }

    public function approves(): HasMany
    {
        return $this->hasMany(ApproveApplication::class);
    }

}
