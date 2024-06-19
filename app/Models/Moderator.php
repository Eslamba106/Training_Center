<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Moderator extends Authenticatable
{
    use HasFactory;
    protected $fillable = ['name' , 'email' , 'password' , 'section_id'];


    public function section(){
        return $this->belongsTo(Section::class);
    }

}
