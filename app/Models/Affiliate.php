<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'refferal_by',
        'discount',
        'status'      
    ];

    public function affiliateUser()
    {
        return $this->hasOne(User::class, 'id', 'refferal_by' );
    }
}
