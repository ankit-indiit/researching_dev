<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicQuizQuestions extends Model
{
    use HasFactory;
    protected $table = 'topic_quiz_questions';
    protected $primaryKey = 'id';
    //protected $with = ['quizname'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $fillable = [
        'topic_id',
        'quiz_id',
        'question',
        'optionA',
        'optionB',
        'optionC',
        'optionD',
        'answer',
        'questionImage',
        'questionLink',
        'questionType',
    ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
    public function quizname(){
        return $this->belongsTo(TopicQuiz::class,'quiz_id','id');   
    }
    
}
