<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rentabilidad extends Model
{
    use HasFactory;

    public function log()
    {
        return $this->hasMany('App\Models\Log_rentabilidad', 'rentabilidad_id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function inversion(){
        return $this->belongsTo('App\Models\Inversion', 'inversion_id');
    }
}
