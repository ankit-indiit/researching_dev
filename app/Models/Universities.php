<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Universities extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    
    protected $fillable = [
        'university_name',
        'logo',
    ];
    
    public function degrees()
    {
        return $this->hasMany(Degrees::class, 'university_id', 'id')->with('allcourses');
    }

    public function courses()
    {
        return $this->hasMany(Course::class, 'university_id', 'id' );
    }      

}
