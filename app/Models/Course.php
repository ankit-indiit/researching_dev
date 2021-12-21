<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    use \Awobaz\Compoships\Compoships;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_name',
        'description',
        'degree_id',
        'price',
        'marathon_price',
        'university_id',
        'course_type',
        'instructor_id',
        'video_link',
        'status',
        'type',
        'event_id',
        'image',
        'topics',
        'start_date',
        'zoom_link',
        'start_time',
        'end_time'
    ]; 
	
    public function degrees()
    {
        return $this->hasOne(Degrees::class, 'id', 'degree_id' );
    }   

    public function university()
    {
        return $this->belongsTo(Universities::class);
    }  

    public function instructors()
    {
        return $this->belongsTo(Instructors::class,'instructor_id','id');
    }

    public function marathonRegisterUser(){
        return $this->hasMany(MarathonOrder::class,'course_id','course_id');
    }

    public function marathonPaidUser(){
        return $this->hasMany(MarathonOrder::class,'course_id','course_id')->where('is_paid',1);
    }
    
}
