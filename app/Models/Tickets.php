<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    protected $table = 'tickets';

    public $timestamps = true;

    protected $fillable = [
        'user_id', 'status', 'priority', 'issue', 'created_at', 'name', 'email','categories'
    ];

    public function getUser()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
