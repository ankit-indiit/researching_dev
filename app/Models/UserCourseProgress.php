<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourseProgress extends Model
{
    use HasFactory;

    protected $table = 'user_course_progresses';

    protected $fillable = [
    	'user_id',
    	'course_id',
    	'type_id',
    	'type',
    ];
}
