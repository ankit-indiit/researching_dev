<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class recommendations extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'course_id',
        'user_id',
        'ratings',
        'instructor_id',
        'instructor_name',
        'descriptions',
        'recommed_tag_line',
        'course_user_social_link',
        'status',
        'is_approved',
        'type',
        'website',
        'is_posted'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
