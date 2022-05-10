<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\question_answer;


class Lectures extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'duration',
        'course_id',
        'topic_id',
        'price'
    ];
    
    public function question_answers(){
        return $this->hasMany(question_answer::class,'lecture_id','id');
    }
    
    
    
}
