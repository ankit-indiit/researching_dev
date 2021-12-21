<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarathonOrder extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class,'course_id','course_id');
    }

    public function previouslyPaid()
    {
        $previously_paid = orders::where('user_id',$this->user->id)->where(function ($query){
            $query->where('status', '=', 'processing')
                  ->orWhere('status', '=', 'completed');
        })->get();
        return ( count($previously_paid) > 0 ) ? 'Yes' : 'No'; 
    }
}
