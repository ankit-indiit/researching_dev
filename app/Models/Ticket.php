<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon;
use App\Models\TicketMessage;
class Ticket extends Model
{
    use HasFactory;
    
    /*protected $table = 'tickets';
    protected $primaryKey = 'id';
    protected $fillable = [
                            'id',
                            'subject',
                            'description',
                        ];
                        */

    public function ticketMessage()
    {
        return $this->hasMany(TicketMessage::class,'ticket_id','id');
    }

    public function getCreatedAtTime($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }
    
    public function getUpdatedAtAttribute($date)
    {
        return Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $date)->format('d/m/Y');
    }

    public function getStatusAttribute($status)
    {
        switch ($status) {
            case "new":
              return "חדש";
              break;
            case "opened":
              return "נפתח";
              break;
            case "closed":
              return "סגור";
              break;
            default:
              return "N/A";
          }
    }    

    public function user()
    {
      return $this->belongsTo(User::class);
    }
}
