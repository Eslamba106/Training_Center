<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    
    protected $fillable = ['name' , 'period'];

    public function moderators()
    {
        return $this->HasMany(Moderator::class);
    }
    
    public function students()
    {
        return $this->HasMany(SectionStudent::class);
    }
}
