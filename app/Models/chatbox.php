<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class chatbox extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'body',
        'uploadfile',
        'user_id',
        'email',
        'status',
        'manager_id',
        'remarks',
        'summary'
    ];
}
