<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type_kyc',
        'photo_forward',
        'photo_rear',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
