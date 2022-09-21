<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Student extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name', 'father_name', 'mother_name', 'phone',
        'dob', 'religion', 'gender', 'username',
        'password', 'pwd_hint', 'address', 'status',
    ];

    protected $hidden = [
        'password, pwd_hint',
    ];

    public function application(): HasOne
    {
        return $this->hasOne(Application::class);
    }

    public function academicInfo(): HasOne
    {
        return $this->hasOne(AcademicInfo::class);
    }


}
