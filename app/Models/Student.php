<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'status',
        'course_id',
    ];

    public function getAgeAttribute(): int
    {
        return $age = date_diff(date_create($this->birthdate), date_create())->y;
    }

    public function getGenderNameAttribute(): string
    {
        return ($this->gender === 0) ? 'Male' : 'Female';
    }
}
