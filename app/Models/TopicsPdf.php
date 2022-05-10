<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class TopicsPdf extends Model
{
    use HasFactory;
    protected $table = 'topic_pdf';
    protected $primaryKey = 'id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'topic_id',
        'topic_pdf_title',
        'topic_pdf_url',
        'order_id',
    ];
    
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    
}
