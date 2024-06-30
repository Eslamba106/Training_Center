<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FinalGraduated extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'final_rate'] ;

    public function finalGraduated()
    {
        return $this->belongsTo(Student::class , "student_id");
    }
}
