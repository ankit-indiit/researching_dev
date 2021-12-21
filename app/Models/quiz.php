<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\quiz_questions;

class quiz extends Model
{
    use HasFactory;

    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quizTopic',
        'quizdescription',
        'lectureId',
        'courseId',
        'topicId',
        'perQuestionMarks',
        'days',
        'quiz_attempt'
    ];
    
    public function quiz_questions()
    {
        return $this->hasMany(quiz_questions::class, 'quiz_id', 'id')->with('all_quiz_questions');
    }
    
    
}
