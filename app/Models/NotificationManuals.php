<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationManuals extends Model
{
    use HasFactory;
    protected $table = 'notification_manuals';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'notification_id',
        'message',
        'sender_id',
        'courses_id',
    ];		
    
    public function course()
    {
        return $this->belongsTo(course::class,'courses_id','course_id');
    }
}
