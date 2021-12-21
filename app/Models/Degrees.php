<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degrees extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;

    protected $fillable = [
        'degree_name',
        'university_id',
    ];

    public function courses()
    {
        return $this->hasOne(Course::class, 'degree_id', 'id' );
    }   
    
    public function allcourses()
    {
        return $this->hasMany(Course::class, ['degree_id', 'university_id'], ['id', 'university_id']);
    }   

    public function university()
    {
        return $this->belongsTo(Universities::class);
    }  
}
