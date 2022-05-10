<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicQuizQuestions;

class TopicQuiz extends Model 
{
    use HasFactory;
    protected $table = 'topic_quiz'; 
    protected $primaryKey = 'id';
    protected $with = ['quizQuestions'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id',
        'quiz_title',
        'order_id',
        'type',
    ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function quizQuestions()
    {
        return $this->hasMany(TopicQuizQuestions::class, 'quiz_id', 'id');
    } 
}
