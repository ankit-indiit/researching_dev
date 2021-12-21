<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class grouped_courses extends Model
{

     use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'groupName',
        'whatsappLink',
        'courseIds',
        'type',
        'price',
        'event_id',
        'link_selected',
        'group_code'
    ];
}
