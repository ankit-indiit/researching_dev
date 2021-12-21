<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'image',
        'category_id',
        'slug',
        'reading_time',
        'references',
        'status',
        'instructor_id',
        'details',
    ];
	
    public function category()
    {
        return $this->hasOne(categories::class, 'id', 'category_id' );
    }   
}
