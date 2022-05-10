<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class notifications extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sender_id',
        'courses_id',
        'title',
        'message',
        'type',
        'manual_id'
    ];

    public function course()
    {
        return $this->belongsTo(course::class,'courses_id','course_id');
    }
}
