<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'referred_id',
        'inversion_id',
        'amount',
        'percentage',
        'liquidation_id',
        'descripcion',
        'tipo_transaccion',
        'status',
        'liquidado',
        'type',
        'amount_fondo',
        'wallet_usd',
        'code_security',
        'option'

    ];

    public function usuarios(){
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Permite obtener la orden de esta comision
     *
     * @return void
     */
    public function getWalletComisiones()
    {
        return $this->belongsTo(OrdenPurchases::class, 'inversion_id', 'id');
    }

    public function inversion()
    {
        return $this->belongsTo(Inversion::class, 'inversion_id', 'id');
    }

    /**
     * Permite obtener al usuario de una comision
     *
     * @return void
     */
    public function getWalletUser()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Permite obtener al referido de una comision
     *
     * @return void
     */
    public function getWalletReferred()
    {
        return $this->belongsTo(User::class, 'referred_id', 'id');
    }


    /**
     * Permite obtener el estado de una transacción
     *
     * @return void
     */
    public function estado()
    {
        if($this->status == 1){
            return '<span class="badge bg-success">Pagado</span>';
        }else if($this->status == 0){
            return '<span class="badge bg-warning">En espera</span>';
        }else{
            return '<span class="badge bg-danger">Cancelado</span>';
        }
    }

}
