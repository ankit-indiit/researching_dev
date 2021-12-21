<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class quiz_questions extends Model
{
    use HasFactory;

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
        'Answer',
        'questionImage',
        'questionType',
        'questionLink'
    ];
}
