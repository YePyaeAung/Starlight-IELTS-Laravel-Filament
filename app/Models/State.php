<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;

    protected $fillable = ['state_code', 'name'];

    public function students()
    {
        return $this->hasMany(Student::class);
    }

    public function townships()
    {
        return $this->hasMany(Township::class);
    }
}
