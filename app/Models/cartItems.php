<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cartItems extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'course_id',
        'name',
        'description',
        'quantity',
        'price',
        'image',
        'item_type',
    ];
}
