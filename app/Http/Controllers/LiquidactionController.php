<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Liquidaction;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Inversion;
use App\Notifications\RetiroAprobado;

class LiquidactionController extends Controller
{
    public function retiros()
    {
        $user = Auth::user()->id;
        $retiros = Liquidaction::where('iduser', $user)->orderBy('id', 'desc')->get();

        return view('business.retiros', compact('retiros'));
    }

    public function solicitudesRetiros()
    {
        $user = Auth::user()->id;
        $null = null;
        $retiros = Liquidaction::where('iduser', $user)->whereNotNull('inversion_id')->orderBy('id', 'desc')->get();

        return view('business.solicitudesRetiros', compact('retiros'));
    }
    public function realizadas()
    {
        $liquidaciones = Liquidaction::where('status', 1)->orderBy('id', 'desc')->get();

        return view('liquidaciones.porGenerar', compact('liquidaciones'));
    }

    public function pendientes()
    {
        $liquidaciones = Liquidaction::where('status', 0)->where('type', 1)->orderBy('id', 'desc')->get();

        return view('liquidaciones.porGenerar', compact('liquidaciones'));
    }

    public function withdraw()
    {
        return view('business.withdraw');
    }

    public function withdrawCapital(Request $request)
    {
        $wallet = $request->wallet;
        $amount = $request->amount;
        $inversionId = $request->inversionId;
        $fee = 0.05;

        $data = [
            'wallet' => $wallet,
            'amount' => $amount,
            'inversionId' => $inversionId,
            'fee' => $fee
        ];

        return view('business.withdraw', compact('data'));
    }



    public function procesarLiquidacion(Request $request)
    {
        $validate = $request->validate([
            'wallet' => ['required'],
            'correo_code' => ['required'],
            'code_security' => ['required']
        ]);

        try {
            $user = Auth::user();

            if($user->code_security === $request->code_security){
                if ($validate) {
                    $correo_code = $request->correo_code;
                    $idliquidation = $request->idLiquidation;
                    $liquidation = Liquidaction::find($idliquidation);
                    
                    if ($liquidation != null) {

                        $liquidation->update([
                            'wallet_used' => $request->wallet,
                        ]);
                    }
                    $user = Auth::user();
                    /* $accion = 'No Procesada';
                    if ($this->reversarRetiro30Min()) {
                        return redirect()->back()->with('msj-danger', 'El tiempo limite fue excedido');
                    }  */
                    //Verifica si ha fallado mucho metiendo los codigo
                    /*  if (session()->has('intentos_fallidos')) {
                        if (session('intentos_fallidos') >= 3) {
                            session()->forget('intentos_fallidos');
                            $request->comentario = 'Demasiados Intentos Fallidos con los códigos';
                            $accion = 'Reversada';
                            $this->reversarLiquidacion($idliquidation, $request->comentario);
                        }
                    }  */
                    //Verifica si los códigos estan bien

                    if ($correo_code != $liquidation->code_correo) {

                        return redirect()->route('wallet.index')->with('danger', 'El código de correo ingresado es incorrecto');
                    } else {



                        //if ($request->action == 'aproved' && session('intentos_fallidos') < 2) {
                        $aproved = $this->aprobarLiquidacion($idliquidation, $request->wallet);

                        if ($aproved == '') {
                            $accion = 'Aprobada';
                            $request->comentario = "Aprobada";

                            $comisiones = Wallet::where([
                                ['user_id', '=', $user->id],
                                ['status', '=', 0],
                                ['liquidado', '=', 0],
                                ['tipo_transaction', '=', 0],
                                ['type', '!=', 5]
                            ])->get();

                            if (!empty($idliquidation)) {
                                $listComi = $comisiones->pluck('id');
                                Wallet::whereIn('id', $listComi)->update([
                                    'status' => 1,
                                    'liquidation_id' => $idliquidation,
                                    'liquidado' => 1
                                ]);
                            }

                            $user = $liquidation->getUserLiquidation;
                            $user->notify(new RetiroAprobado($user));
                            return redirect()->back()->with('success', 'Retiro Exitoso');
                        } else {
                            $comentario = 'Error en la plataforma de coinpayment';
                            $this->reversarLiquidacion($idliquidation, $comentario);
                            return redirect()->route('wallet.index')->with('danger', 'Hubo un error al realizar el pago. ' . $aproved);
                        }
                        //}


                        if ($accion != 'No Procesada') {
                            $arrayLog = [
                                'idliquidation' => $idliquidation,
                                'comentario' => $request->comentario,
                                'accion' => $accion
                            ];
                            DB::table('log_liquidactions')->insert($arrayLog);
                        }
                    }

                    return redirect()->route('wallet.index')->with('message', 'La Liquidación fue ' . $accion . ' con exito');
                }
            }else{
                return back()->with('danger', 'pin de seguridad invalido');
            }
        } catch (\Throwable $th) {
            Log::error('Liquidaction - saveLiquidation -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cambiarStatus(Request $request)
    {

        if ($request->status == 1) {

            $liquidacion = Liquidaction::where('id', $request->id)->first();
            try {
                $idliquidation = $liquidacion->id;
                $liquidation = Liquidaction::find($idliquidation);

                $Inversion = Inversion::where('id', $liquidation->inversion_id)->first();
                $Inversion->capital -= $liquidation->monto_bruto;
                if ($Inversion->capital <= 0) {
                    $Inversion->capital = 0;
                    $Inversion->status = 2;
                }
                $Inversion->save();

                Liquidaction::where('id', $idliquidation)->update([
                    'status' => 1,
                ]);

                $accion = 'Aprobada';

                $arrayLog = [
                    'idliquidation' => $idliquidation,
                    'accion' => $accion
                ];
                DB::table('log_liquidactions')->insert($arrayLog);

                $user = $liquidation->getUserLiquidation;
                $user->notify(new RetiroAprobado($user));

                return back()->with('success', 'La liquidación fue aprobada con éxito');
            } catch (\Throwable $th) {
                Log::error('Liquidaction - saveLiquidation -> Error: ' . $th);
                abort(403, "Ocurrio un error, contacte con el administrador");
            }
        } else {
            try {
                DB::beginTransaction();
                $liquidacion = Liquidaction::findOrFail($request->id);
                $liquidacion->status = $request->status;
                $liquidacion->save();


                DB::commit();

                return back()->with('success', 'Status cambiado exitosamente');
            } catch (\Throwable $th) {

                DB::rollback();

                Log::error('Retiro - cambiarStatus -> Error: ' . $th);
                abort(403, "Ocurrio un error, contacte con el administrador");
            }
        }
    }



    public function aprobarLiquidacion($idliquidation, $billetera): string
    {
        $liquidation = Liquidaction::find($idliquidation);
        //dd($liquidation);
        // creo el arreglo de la transacion en coipayment
        $cmd = 'create_withdrawal';
        $result2 = '';
        $dataPago = [
            'amount' => $liquidation->total,
            'currency' => 'USDT.TRC20',
            'address' => $billetera,
        ];
        // llamo la a la funcion que va a ser la transacion
        $result = $this->coinpayments_api_call($cmd, $dataPago);
        if (!empty($result['result'])) {
            Liquidaction::where('id', $idliquidation)->update([
                'status' => 1,
                'hash' => $result['result']['id'],
                'wallet_used' => $billetera
            ]);

            Wallet::where('liquidation_id', $idliquidation)->update(['liquidado' => 1, 'status' => 1]);
        } else {
            $result2 = 'Error -> ' . $result['error'];
        }
        //dd($result);
        return $result2;
    }

    public function reversarLiquidacion($idliquidation, $comentario)
    {
        $liquidacion = Liquidaction::find($idliquidation);

        Wallet::where('liquidation_id', $idliquidation)->update([
            'status' => 2,
            'liquidation_id' => null,
        ]);

        // $concepto = 'Liquidacion Reservada - Motivo: '.$comentario;
        // $arrayWallet =[
        //     'user_id' => $liquidacion->iduser,
        //     'orden_purchases_id' => null,
        //     'referred_id' => $liquidacion->iduser,
        //     'monto' => $liquidacion->monto_bruto,
        //     'descripcion' => $concepto,
        //     'status' => 3,
        //     'tipo_transaction' => 0,
        // ];

        // $this->walletController->saveWallet($arrayWallet);

        $liquidacion->status = 0;
        $liquidacion->save();
    }

    public function coinpayments_api_call($cmd, $req = array())
    {
        // Fill these in from your API Keys page
        //$public_key = Crypt::decryptString( env('COIN_PAYMENT_PUBLIC_KEY', '') ) ;
        //$private_key =  Crypt::decryptString( env('COIN_PAYMENT_PRIVATE_KEY', '') ) ;
        $public_key = env('COINPAYMENT_PUBLIC_KEY', 'f1126d3dc6193390e567951552f69d60e195b9f600a7514dfc856b8619527c7a');
        $private_key = env('COINPAYMENT_PRIVATE_KEY', '4dc6ca4af4Ebb11Bb60754981bd060f4EA0122e13311f8Ebb7582bc575804D96');

        // Set the API command and required fields
        $req['version'] = 1;
        $req['cmd'] = $cmd;
        $req['key'] = $public_key;
        $req['format'] = 'json'; //supported values are json and xml

        // Generate the query string
        $post_data = http_build_query($req, '', '&');

        // Calculate the HMAC signature on the POST data
        $hmac = hash_hmac('sha512', $post_data, $private_key);

        // Create cURL handle and initialize (if needed)
        static $ch = NULL;
        if ($ch === NULL) {
            $ch = curl_init('https://www.coinpayments.net/api.php');
            curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('HMAC: ' . $hmac));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);

        // Execute the call and close cURL handle
        $data = curl_exec($ch);
        // Parse and return data if successful.
        if ($data !== FALSE) {
            if (PHP_INT_SIZE < 8 && version_compare(PHP_VERSION, '5.4.0') >= 0) {
                // We are on 32-bit PHP, so use the bigint as string option. If you are using any API calls with Satoshis it is highly NOT recommended to use 32-bit PHP
                $dec = json_decode($data, TRUE, 512, JSON_BIGINT_AS_STRING);
            } else {
                $dec = json_decode($data, TRUE);
            }
            if ($dec !== NULL && count($dec)) {
                return $dec;
            } else {
                // If you are using PHP 5.5.0 or higher you can use json_last_error_msg() for a better error message
                return array('error' => 'Unable to parse JSON result (' . json_last_error() . ')');
            }
        } else {
            return array('error' => 'cURL error: ' . curl_error($ch));
        }
        // dd($this->coinpayments_api_call('rates'));
    }

    public function saveLiquidation(array $data): int
    {
        $liquidacion = Liquidaction::create($data);
        return $liquidacion->id;
    }

    public function sendCodeEmail()
    {
        try {
            $this->reversarRetiro30Min();
            /* if (!session()->has('intentos_fallidos')) {
                session(['intentos_fallidos' => 1]);
            }  */

            $user = Auth::user();
       
            $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->get();
        
            $bruto = $comisiones->sum('amount_fondo');
            if ($bruto < 60) {
                return response()->json(['message' => 'el monto minimo es 60']);
            }

            $feed = ($bruto * 0.05);
            $total = ($bruto - $feed);


            $arrayLiquidation = [
                'iduser' => $user->id,
                'total' => $total,
                'monto_bruto' => $bruto,
                'feed' => $feed,
                'hash',
                // 'wallet_used' => $user->wallet,
                'status' => 0,
                'code_correo' => Str::random(10),
                'fecha_code' => Carbon::now()
            ];
            $idLiquidation = $this->saveLiquidation($arrayLiquidation);

            $dataEmail = [
                'total' => $total,
                'user' => $user->fullname(),
                'code' => $arrayLiquidation['code_correo']
            ];
          
            Mail::send('mail.SendCodeRetiro', $dataEmail,  function ($msj) use ($user) {
                $msj->subject('Codigo Retiro');
                $msj->to($user->email);
            });
            
            return $idLiquidation;

        } catch (\Throwable $th) {
            Log::error('Liquidaction - sendCodeEmail -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function reversarRetiro30Min(): bool
    {
        $liquidation = Liquidaction::where([
            ['iduser', '=', Auth::id()],
            ['status', '=', 0],
            ['type', '=', 0]
        ])->first();
        $result = false;
        if ($liquidation != null) {
            $fechaActual = Carbon::now();
            $fechaCodeCorreo = new Carbon($liquidation->fecha_code);
            if ($fechaCodeCorreo->diffInMinutes($fechaActual) >= 30) {
                $this->reversarLiquidacion($liquidation->id, 'Tiempo limite de codigo sobrepasado');
                $result = true;
            }
        }
        return $result;
    }

    public function aprobarRetiro(Request $request)
    {
        $idLiquidation = $this->sendCodeEmail();
        return response()->json($idLiquidation);
        //return view('business.componentes.modalAprobar', compact('data'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $user = auth()->user();

            $wallets = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->get();
                
          /* $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->get(); */
    
            $saldoDisponible = $wallets->sum('amount_fondo');
            $fee = $saldoDisponible * 0.05;
            
            $wallet = Wallet::where('user_id', '=', $user->id )->orderBy('id','desc')->get();

            return view('wallet.index', compact('saldoDisponible', 'fee', 'wallet'));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function montoBono(Request $request)
    {
        $wallets = Wallet::where('type', $request->bono)->where('user_id', $request->user_id)->orderBy('id', 'desc')->sum('amount_fondo');
        return response()->json($wallets);
    }

     public function indexAdmin()
    {
        try {
           $user = auth()->user();
           $wallets = Wallet::where('type', '!=', '5')->orderBy('id', 'desc')->get();
           
          /* $comisiones = Wallet::where([
                ['user_id', '=', $user->id],
                ['status', '=', 0],
                ['liquidado', '=', 0],
                ['tipo_transaction', '=', 0],
                ['type', '!=', 5]
            ])->get();*/
    
            $saldoDisponible = $wallets->sum('amount_fondo');

            return view('wallet.ComponentsAdmin.wallet', compact('wallets', 'saldoDisponible'));
        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

 /**
     * Permite revisar el estado de las ordenes en coinpayment y las reversas si fueron canceladas
     *
     * @return void
     */
    public function checkWithDrawCoinpayment()
    {
        $fecha = Carbon::now();
        $liquidaciones = Liquidaction::whereDate('created_at', '>=', $fecha->subDays(1))->where('status', 1)->orderBy('id', 'desc')->get();
        $cmd = 'get_withdrawal_info';
        foreach ($liquidaciones as $liquidacion) {
            if (!empty($liquidacion->hash) && strlen($liquidacion->hash) <= 32) {
                $data = ['id' => $liquidacion->hash];
                // Log::info('Liquidacion: '.$liquidacion->id);
                $resultado = $this->coinpayments_api_call($cmd, $data);
                // dump($resultado);
                if (!empty($resultado['result'])) {
                    if ($resultado['result']['status'] == -1) {
                        $this->reversarLiquidacion($liquidacion->id, 'Cancelado por coinpayment');
                        Log::info('Liquidacion: '.$liquidacion->id.' Fue Cancelada por coinpayment');
                    }
                }
            }
        }
    }


}
