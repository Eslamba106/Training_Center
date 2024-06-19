<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionStudent extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'student_id', 'section_id', 'from', 'to'];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
