<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApproveApplication extends Model
{
    use HasFactory;

    protected $with = ['applications'];

    protected $fillable = [
        'application_id', 'inst_id', 'user_id', 'comments',
        'sharok_no', 'is_approved', 'approve_at', 'is_parent',
        'parent_inst_id','parent_user_id'
    ];

    public function applications()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function institute()
    {
        return $this->belongsTo(InstInfo::class, 'inst_id', 'id');
    }
}
