<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApproveApplication extends Model
{
    use HasFactory;

    protected $with = ['applications'];

    protected $fillable = [
        'application_id', 'inst_id', 'user_id', 'comment_id',
        'sharok_no', 'is_approved', 'approve_at', 'is_parent',
        'parent_id', 'status', 'is_revert'
    ];


    public function applications(): BelongsTo
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    public function admin(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comment(): BelongsTo
    {
        return $this->belongsTo(Comment::class);
    }

    public function scopeActive($q)
    {
        $q->where('status', 1);
    }
}
