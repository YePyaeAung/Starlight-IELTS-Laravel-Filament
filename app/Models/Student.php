<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'age',
        'fee',
        'address',
        'course_id',
        'township_id',
        'state_id',
        'course_end_date'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function township()
    {
        return $this->belongsTo(Township::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
