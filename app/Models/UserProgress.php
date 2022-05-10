<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
     
    protected $table = 'user_progress';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'user_id',
                            'course_id',
                            'topic_id',
                            'video_ids',
                            'pdf_ids',
                            'status',
                        ];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
