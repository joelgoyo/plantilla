<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Liquidaction extends Model
{
    use HasFactory;

    protected $table = 'liquidactions';

    protected $fillable = [
        'iduser', 'inversion_id', 'total', 'monto_bruto', 'feed', 'hash',
        'wallet_used', 'status', 'code_correo', 'fecha_code', 'type',
    ];

    /**
     * Permite la informacion del usuario que se esta liquidando
     *
     * @return void
     */
    public function getUserLiquidation()
    {
        return $this->belongsTo('App\Models\User', 'iduser', 'id');
    }

    public function getInversionLiquidation(){
        return $this->belongsTo('App\Models\Inversion', 'inversion_id' , 'id');
    }

    /**
     * Permite obtener la informacion de obtener los comentarios sobre la liquidacion
     *
     * @return void
     */
    public function getLogLiquidation()
    {
        return $this->hasMany('App\Models\LogLiquidation', 'idliquidation');
    }

    public function status()
    {
        if ($this->status == '0'){
            return "Pendiente";
        }elseif($this->status == '1'){
            return "Realizada";
        }
    }
}
