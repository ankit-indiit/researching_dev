<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class couponcode extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'coupon_name',
    	'coupon_code',
    	'type',
    	'value',
    	'coupon_type',
    	'university_name',
    	'course_name',
        'degree_name',
        'started_at',
    	'expired_at'

    ];
}
