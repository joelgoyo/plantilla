<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenPurchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','amount', 'fee',
        'status', 'type'
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function inversion()
    {
        return $this->hasOne('App\Models\Inversion', 'orden_purchases_id');
    }

    public function status()
    {
        if ($this->status == '0'){
            return "Esperando";
        }elseif($this->status == '1'){
            return "Aprobado";
        }elseif($this->status >= '2'){
            return "Rechazada";
        }
    }

   public function cointpayment()
   {
     return $this->hasOne('Hexters\CoinPayment\Entities\CoinpaymentTransaction', 'order_id');
    }

    public function coinpayment_alternativa_link()
    {
        return $this->cointpayment->status_url;
    }
}
