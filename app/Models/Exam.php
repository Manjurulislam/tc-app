<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'status',
    ];

    protected $hidden = [
        'created_at', 'updated_at', 'status',
    ];


    public function applications()
    {
        return $this->belongsToMany(Application::class);
    }


    public function scopeActive($query)
    {
        $query->where('status', 1);
    }

}
