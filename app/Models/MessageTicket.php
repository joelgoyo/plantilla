<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageTicket extends Model
{
    protected $table = 'message_tickets';

    protected $fillable = [
        'user_id', 'id_admin', 'id_ticket', 'type', 'message', 'created_at','image'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
    public function getAdmin()
    {
        return $this->belongsTo('App\Models\User', 'id_admin', 'id');
    }

    public function getTicket()
    {
        return $this->belongsTo('App\Models\Tickets', 'id_ticket', 'id');
    }
}
