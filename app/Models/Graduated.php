<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Graduated extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'student_id', 'section_id', 'rate', 'graduated_date' ,'percentage'
    ];
    
    public function students()
    {
        return $this->belongsTo(Student::class , 'student_id');
    }
    public function sections()
    {
        return $this->belongsTo(Section::class ,'section_id');
    }
}
