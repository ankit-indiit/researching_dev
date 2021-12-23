<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Homepage extends Model
{
    use HasFactory;
    protected $table = 'homepages';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'banner_text',
        'banner_image',
        'banner_background',
        'banner_facebook',
        'banner_insta',
        'banner_whatsapp',
        'banner_list',
    ];						

}
