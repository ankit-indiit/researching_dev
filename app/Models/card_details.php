<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class card_details extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'card_number',
        'card_type',
        'stripe_card_id',
        'customer_id',
        'is_default',
        'card_holder_name',
    ];
}
