<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{
    use HasFactory;
    protected $table = 'quiz_answers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'topic_id',
        'question_id',
        'quiz_id',
        'choose_answer_option',
    ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
