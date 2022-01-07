<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;
    
    protected $appends = ['full_name'];

    protected $with = ['user','course'];
    
    protected $fillable = [
        'order_number', 'user_id','ordered_courses','course_type', 'status', 'grand_total', 'item_count', 'payment_status', 'payment_method',
        'first_name', 'last_name', 'address', 'city', 'country', 'company_name','email', 'phone_number', 'notes'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(course::class,'ordered_courses','course_id');
    }

    public function getFullNameAttribute() 
    {
        return $this->first_name . ' ' . $this->last_name;
    }

}
