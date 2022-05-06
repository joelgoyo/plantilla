<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\MyResetPassword;
use App\Models\Wallet;
use App\Models\kyc;
use App\Models\Inversion;
use App\Models\Countrie;
use App\Models\Prefix;
use Illuminate\Support\Facades\DB;
use App\Models\Rentabilidad;
use App\Http\Traits\Tree;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use App\Notifications\VerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, Tree;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'username',
        'photo',
        'email',
        'password',
        'referred_id',
        'date_activo',
        'birthdate',
        'countrie_id',
        'identification_document',
        'gender',
        'type_document',
        'phone',
        'code_postal',
        'city',
        'direction',
        'Prefix_id',
        'wallet',
        'code_security'
    ];

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = [
        'date_activo'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function countrie()
    {
        return $this->belongsTo('App\Models\Countrie', 'countrie_id');
    }
    public function prefix()
    {
        return $this->belongsTo('App\Models\Prefix', 'prefix_id');
    }
    public function kyc()
    {
        return $this->belongsTo(kyc::class, 'id', 'user_id');
    }

    public function referidos()
    {
        return $this->hasMany(User::class, 'referred_id');
    }

    public function fullName()
    {
        return $this->name . ' ' . $this->lastname;
    }

    public function Invertido()
    {
        return $this->belongsTo(Inversion::class, 'id', 'user_id');
    }

    public function ordenes()
    {
        return $this->hasMany(OrdenPurchases::class, 'user_id');
    }

    public function inversiones()
    {
        return $this->hasMany(Inversion::class, 'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function ganancias()
    {
        $gain = 0;
        if (count($this->inversiones) > 0) {
            $gain = $this->inversiones->where('status', 1)->sum('gain');
        }

        return $gain;
    }

    public function progreso()
    {
        $gain = $this->inversiones->where('status', 1)->sum('gain');
        $capital = $this->inversiones->where('status', 1)->sum('capital');
        if ($capital > 0) {
            return ($gain / $capital) * 100;
        } else {
            return 0;
        }
    }

    /**
     * Permite obtener todas las ordenes de compra de saldo realizadas
     *
     * @return void
     */
    public function getWallet()
    {
        return $this->hasMany(Wallet::class, 'user_id')->orderBy('id', 'desc')->where('type', '!=', '5');
    }

    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void
     */
    public function getUserOrden()
    {
        return $this->belongsTo(OrdenPurchases::class, 'id', 'user_id');
    }

    /* public function ordenes()
    {
        return $this->hasMany('App\Models\OrdenPurchases', 'user_id');
    } */


    /**
     * Permite obtener las ordenes de servicio asociada a una categoria
     *
     * @return void
     */
    public function investmentHigh()
    {
        return $this->getUserInversiones()->where('status', 1)->orderBy('invested', 'desc')->first();
        //->sortByDesc('invertido')
    }

    public function montoInvertido()
    {
        $amount = 0;
        $inversion = $this->inversiones->where('status', 1)->sortByDesc('invested')->first();
        if (isset($inversion)) {
            $amount += $inversion->invested;
        }

        return number_format($amount, 2);
    }

    public function inversionMasAlta()
    {
        return $this->inversiones->where('status', 1)->sortByDesc('invested')->first();
    }

    public function paquete()
    {
        $paquete = "";

        $inversiones = $this->inversiones->where('status', 1)->sortByDesc('invested')->first();

        if (isset($inversiones)) {
            switch ($inversiones->invested) {
                case $inversiones->invested >= 500 && $inversiones->invested <= 4900:

                    $paquete = 'FRESHMAN INVESTOR';
                    break;
                case $inversiones->invested >= 5000 && $inversiones->invested <= 14900:
                    $paquete = 'JUNIOR INVESTOR';
                    break;
                case $inversiones->invested >= 15000 && $inversiones->invested <= 29900:
                    $paquete = 'SENIOR INVESTOR';
                    break;
                case $inversiones->invested >= 30000 && $inversiones->invested <= 49900:
                    $paquete = 'MASTER INVESTOR';
                    break;
                case $inversiones->invested >= 50000 && $inversiones->invested <= 149000:
                    $paquete = 'MASTER PRO INVESTOR';
                    break;
                case $inversiones->invested >= 150000 && $inversiones->invested <= 299000:
                    $paquete = 'EXCELSIOR INVESTOR';
                    break;

                default:

                    break;
            }
        }
        return $paquete;
    }

    public function getClassPackage()
    {
        $class = "";
        $inversions = $this->inversiones->where('status', 1)->sortByDesc('invested')->first();
        if (isset($inversions)) {
            switch ($inversions->invested) {
                case $inversions->invested >= 500 && $inversions->invested <= 4900:
                    $class = 'freshman';
                    break;
                case $inversions->invested >= 5000 && $inversions->invested <= 14900:
                    $class = 'freshman';
                    break;
                case $inversions->invested >= 15000 && $inversions->invested <= 29900:
                    $class = 'senior';
                    break;
                case $inversions->invested >= 30000 && $inversions->invested <= 49900:
                    $class = 'master';
                    break;
                case $inversions->invested >= 50000 && $inversions->invested <= 149000:
                    $class = 'master-pro';
                    break;
                case $inversions->invested >= 150000 && $inversions->invested <= 299000:
                    $class = 'excelsior';
                    break;

                default:

                    break;
            }
        }

        return $class;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function montoTotalInvertido()
    {
        $amount = 0;
        $inversiones = $this->inversiones->where('status', 1)->sortByDesc('invested');

        foreach ($inversiones as $inversion) {
            $amount += $inversion->invested;
        }


        return number_format($amount, 2);
    }

    public function availableBalance()
    {
        return number_format($this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount'), 2);
    }

    /**
     * muestra el saldo disponible en numeros
     *
     * @return float
     */
    public function saldoDisponible(): float
    {
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount_fondo');
    }

    public function saldoDisponibleNumber(): float
    {
        return $this->getWallet->where('status', 0)->where('tipo_transaction', 0)->sum('amount_fondo');
    }

    public function getFeeWithdraw(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            $result = ($disponible * 0.05);
        }
        return floatval($result);
    }

    public function totalARetirar(): float
    {
        $result = 0;
        $disponible = $this->saldoDisponibleNumber();
        if ($disponible > 0) {
            $result = ($disponible - $this->getFeeWithdraw());
        }
        return floatval($result);
    }

    public function gananciaActual()
    {
        if (isset($this->investmentHigh()->gain) && $this->investmentHigh()->gain != null) {
            return number_format($this->investmentHigh()->gain, 2);
        } else {
            return number_format(0, 2);
        }
    }


    public function hasReactivacion()
    {
        $hoy = \Carbon\Carbon::now();
        $date = $this->date_activo->addMonth(1);

        if ($hoy->gt($date)) {
            return true;
        }

        return false;
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MyResetPassword($token, $this->email));
    }

    public function getUser()
    {
        return $this->hasMany('App\Models\User', 'type');
    }

    public function countReferidosDirectos()
    {
        $referidos = $this->getChildrens($this, new Collection, 1);

        return count($referidos->where('nivel', 1));
    }

    public function padre()
    {
        return $this->belongsTo('App\Models\User', 'referred_id');
    }

    function bonoIndirecto()
    {

        $bonoIndirecto = Wallet::where([['user_id', '=', Auth::id()],['type', '=', 6]])->sum('amount');

        return $bonoIndirecto;
    }


    public function bonoInicio()
    {
        $bonoInicio = Wallet::where([['user_id', '=', Auth::id()],['type', '=', 0]])->sum('amount');

        return $bonoInicio;
    }

    public function Activacion()
    {
        $bonoRecompra = Wallet::where([['user_id', '=', Auth::id()],['type', '=', 1]])->sum('amount');

        return $bonoRecompra;
    }

    public function cartera()
    {
        $bonoCartera = Wallet::where([['user_id', '=', Auth::id()],['type', '=', 2]])->sum('amount');

        return $bonoCartera;
    }
    public function rendimiento()
    {
        $Rendimiento = Wallet::where([['user_id', '=', Auth::id()],['type', '=', 5]])->sum('amount');

        return $Rendimiento;
    }

    public function disponible()
    {
        $disponible = Wallet::where([['user_id', '=', Auth::id()],['tipo_transaction', '=', 0], ['type', '!=', 5]])->sum('amount');

        return $disponible;
    }

    public function totalIngresos()
    {
        $totalIngresos = Wallet::where([['user_id', '=', Auth::id()],['status', '=', 0], ['type', '!=', 5]])->sum('amount');

        return $totalIngresos;
    }
}
