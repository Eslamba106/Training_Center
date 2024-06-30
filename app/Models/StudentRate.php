<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentRate extends Model
{
    use HasFactory;

    protected $guarded =[];

    public function student_rate(){
        return $this->belongsToMany(Student::class , 'student_id') ;
    }

    public function rates()
    {
        return $this->belongsTo(Rate::class , 'rate_id');
    }
    public function section_rate()
    {
        return $this->belongsTo(Section::class , 'section_id');
    }
}
