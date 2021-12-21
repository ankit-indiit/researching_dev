<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactus extends Model
{
    use HasFactory;
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'phonenumber1',
    	'phonenumber2',
    	'address1',
    	'address2',
    	'youtube_link',
    	'insta_link',
    	'facebook_link',
    	'longitude1',
    	'lattitude1',
    	'longitude2',
    	'lattitude2',

    ];
}
