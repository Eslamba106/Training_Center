<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'password'];

//, 'student_section_id' , 'from' , 'to'
    public function student_rate()
    {
        return $this->hasMany(StudentRate::class);
    }

    // علاقة بين جدول الطلاب وجدول الحضور والغياب
    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }
    public function student_section()
    {
        return $this->hasMany(SectionStudent::class, 'student_id');
    }
}
