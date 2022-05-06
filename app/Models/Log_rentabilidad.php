<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log_rentabilidad extends Model
{
    use HasFactory;

    protected $fillable = [
        'inversion_id','wallet_id', 'percentage', 'month',
        'year', 'previoues_amount', 'current_amount', 'rentabilidad_id'
    ];
    public function inversion()
    {
        return $this->belongsTo('App\Models\Inversion', 'inversion_id', 'id');
    }

    public function wallet()
    {
        return $this->belongsTo('App\Models\Wallet', 'wallet_id');
    }
}
