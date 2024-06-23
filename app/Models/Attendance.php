<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;
    protected $fillable=[
        'student_id',
        'section_id',
        'moderators_id',
        'attendence_date',
        'attendence_status',
        'excused'
    ];

    public function students_attendance()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }

}
