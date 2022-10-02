<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class InstInfo extends Authenticatable
{
    use HasFactory, Notifiable;

//    protected $with=['applications'];

    protected $fillable = [
        'eiin', 'code', 'inst_Name', 'pass1', 'pass2', 'is_confirm', 'student_count'
    ];

    public function approves(): HasMany
    {
        return $this->hasMany(ApproveApplication::class,'inst_id','id');
    }

}
