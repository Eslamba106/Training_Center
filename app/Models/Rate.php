<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rate extends Model
{
    use HasFactory; 

    public $fillable = ['title' , 'section_id'];

    public function section()
    {
        return $this->belongsTo(Section::class , 'section_id');
    }
    public function rates()
    {
        return $this->hasMany(StudentRate::class);
    }
}
