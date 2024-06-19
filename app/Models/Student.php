<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Authenticatable 
{
    use HasFactory;
    protected $fillable = ['name' , 'email' , 'password' ];

//, 'student_section_id' , 'from' , 'to'
    // public function student_section(){
    //     return $this->belongsTo(Section::class);
    // }
}
