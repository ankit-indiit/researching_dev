<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketMessage extends Model
{
    use HasFactory;
    
    /*protected $table = 'ticket_messages';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'ticket_id',
                            'message',
                            'user_type',
                        ];*/
    
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
