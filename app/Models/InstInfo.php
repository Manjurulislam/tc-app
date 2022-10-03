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
        'eiin_no', 'inst_name', 'thana', 'zilla',
        'password', 'password2', 'password_raw',
        'user_role','image_name','signature_image',
        'remember_token'
    ];

    public function approves(): HasMany
    {
        return $this->hasMany(ApproveApplication::class,'inst_id','id');
    }

}
