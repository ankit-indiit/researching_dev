<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\TopicVideos;
use App\Models\TopicQuiz;
use App\Models\TopicsPdf;

class Topics extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $with = ['topicVideos','topic_pdf','topic_quiz'];
    protected $fillable = [
        'topic_name',
        'topic_duration',
        'lecture_id',
        'course_id',
        'topic_price',
    ];
    
    public function topicVideos()
    {
        return $this->hasMany(TopicVideos::class,'topic_id','id');
    }
    
    public function topic_pdf()
    {
        return $this->hasMany(TopicsPdf::class, 'topic_id', 'id');
    }
    
    public function topic_quiz()
    {
        return $this->hasMany(TopicQuiz::class, 'topic_id', 'id');
    }
    
    
}
