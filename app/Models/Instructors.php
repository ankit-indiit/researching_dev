<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructors extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'instructor_course_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'contact_number',
        'avatar',
        'about',
        'destiny',
        'university',
        'degree',
        'qualifications',
        'insta_link',
        'facebook_link',
        'whatspp_link',
        'linkedin_link',
        'recommendations',

    ];

    public function recomendations()
    {
        return $this->hasMany(recommendations::class, 'instructor_id', 'id')->where('status', '=', '1')->where('is_approved', '=', '1')->where('type', '=', 'instructor');
    }
    
}
