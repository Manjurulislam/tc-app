<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $fillable = [
        'eiin_no', 'inst_name', 'thana', 'zilla',
        'password', 'password2', 'password_raw',
        'user_role', 'image_name', 'signature_image',
        'remember_token', 'password2_raw'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
    ];


    public static $role = [
        1 => 'Admin',// super admin
        2 => 'College',
        3 => 'Admin', //1
        4 => 'Admin', // 2
        5 => 'Admin', // 3
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'password2',
        'password_raw',
        'password2_raw',
        'remember_token',
        'created_at',
        'updated_at',
    ];


    public function approves(): HasMany
    {
        return $this->hasMany(ApproveApplication::class, 'user_id', 'id');
    }
}
