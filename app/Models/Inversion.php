<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inversion extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','orden_purchases_id','invested', 'gain', 'capital',
        'status','pay_rentabilidad'
    ];

    public function orden()
    {
        return $this->belongsTo('App\Models\OrdenPurchase', 'orden_purchases_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
    
    public function estado()
    {
        if($this->status == 1){
            return '<span class="badge bg-success">Activo</span>';
        }else{
            return '<span class="badge bg-danger">Culminado</span>';
        }
    }

    public function wallets()
    {
        return $this->hasMany('App\Models\Wallet', 'inversion_id');
    }

    public function ganancia()
    {
        return $this->wallets->where('tipo_transaction', 0)->where('status', 0)->sum('amount');
    }

    public function ganancia_rendimiento()
    {
        return $this->wallets->where('tipo_transaction', 0)->where('status', 0)->where('type', 5)->sum('amount');
    }
}
