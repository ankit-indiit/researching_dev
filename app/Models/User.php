<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\contactsnew;


class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $appends = ['full_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
		'description',
        'academic_institution',
        'student_degree',
        'contact_number',
        'facebook_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
        'provider_id',
        'avatar',
        'status',
        'reffer_by',
        'reffer_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function messages() {
        return $this->hasMany(message::class);
    }

    public function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function universities()
    {
        return $this->hasOne(Universities::class,'id','academic_institution')->select('university_name');
    }
        
    public function degree()
    {
        return $this->hasOne(Degrees::class,'id','student_degree')->select('degree_name');
    }
}
