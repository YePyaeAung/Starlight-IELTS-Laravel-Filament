<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_image',
        'name',
        'email',
        'phone',
        'date_of_birth',
        'address',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
