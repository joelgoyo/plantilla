<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use App\Models\OrdenPurchase;
use Illuminate\Support\Facades\Storage;
use App\Http\Traits\Tree;
use Hexters\CoinPayment\CoinPayment;
use DB;
use App\Http\Controllers\InversionController;
use App\Models\User;
use App\Events\UserEvent;
use App\Models\Inversion;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class TiendaController extends Controller
{
    //
    use Tree;

    public function __construct()
    {
        $this->InversionController = new InversionController;
    }

    public function index(Request $request)
    {

        return view('shop.index');
    }


    public function transaction(Request $request)
    {

        $User_id = Auth::user()->id;
        $orden = Inversion::where([['user_id', $User_id], ['status', 1]])->count('id');

        if ($orden > 0) {
            $fee = 0;
        } else {
            $fee = 150;
        }

        switch ($request->package) {
            case 1:
                $data = [
                    'name' => 'FRESHMAN INVESTOR',
                    'monto' => 'U$500 - U$4900',
                    'activacion_manual' => 'U$12',
                    'clase' => 'freshman',
                    'paquete' => 1,
                    'minimo' => '500',
                    'maximo' => '4900'
                ];
                break;

            case 2:
                $data = [
                    'name' => 'JUNIOR INVESTOR',
                    'monto' => 'U$5000 - U$14900',
                    'activacion_manual' => 'U$20',
                    'clase' => 'freshman',
                    'paquete' => 2,
                    'minimo' => '5000',
                    'maximo' => '14900'
                ];
                break;

            case 3:
                $data = [
                    'name' => 'SENIOR INVESTOR',
                    'monto' => 'U$15000 - U$29900',
                    'activacion_manual' => 'U$35',
                    'clase' => 'senior',
                    'paquete' => 3,
                    'minimo' => '15000',
                    'maximo' => '29900'
                ];
                break;

            case 4:
                $data = [
                    'name' => 'MASTER INVESTOR',
                    'monto' => 'U$30000 - U$49900',
                    'activacion_manual' => 'U$50',
                    'clase' => 'master',
                    'paquete' => 4,
                    'minimo' => '30000',
                    'maximo' => '49900'
                ];
                break;

            case 5:
                $data = [
                    'name' => 'MASTER PRO',
                    'monto' => 'U$50000 - U$149000',
                    'activacion_manual' => 'U$80',
                    'clase' => 'master-pro',
                    'paquete' => 5,
                    'minimo' => '50000',
                    'maximo' => '149000'
                ];
                break;

            case 6:
                $data = [
                    'name' => 'EXCELSIOR INVESTOR',
                    'monto' => 'U$150000 - U$299000',
                    'activacion_manual' => 'U$100',
                    'clase' => 'excelsior',
                    'paquete' => 6,
                    'minimo' => '150000',
                    'maximo' => '299000'
                ];
                break;

            default:
                $data = [
                    'name' => 'FRESHMAN INVESTOR',
                    'monto' => 'U$500 - U$4900',
                    'activacion_manual' => 'U$12',
                    'clase' => 'freshman',
                    'paquete' => 1,
                    'minimo' => '500',
                    'maximo' => '4900'
                ];
                break;
        }
        return view('shop.trans', compact('data', 'fee'));
    }



    public function procesarOrden(Request $request)
    {

        $User_id = Auth::user()->id;
        $orden = Inversion::where([['user_id', $User_id], ['status', 1]])->count('id');


        $validate = $request->validate([

            'minimo' => 'required',
            'maximo' => 'required',

        ]);

        try {
            if ($validate) {

                if (($request->monto < $request->minimo) || ($request->monto > $request->maximo)) {
                    return redirect()->route('shop')->with('info', 'El monto que ha ingresado es no corresponde al paquete seleccionado');
                }
                if (!isset($request->monto)) {
                    return redirect()->route('shop')->with('danger', 'Por favor ingrese un monto.');
                }

                if ($orden > 0) {
                    $fee = 0;
                    $data = [
                        'user_id' => Auth::id(),
                        'amount' => $request->monto,
                        'fee' => $fee,
                    ];

                    $data['idorden'] = $this->saveOrden($data);
                    $user = Auth::user();
                    $data['name'] = $user->name;
                    $data['email'] = $user->email;
                    $data['total'] = $data['amount'] + $fee;
                    $data['descripcion'] = "Inversion contrato";

                    $url = $this->generalUrlOrden($data);

                    if (!empty($url)) {
                        return redirect($url);
                    } else {
                        OrdenPurchase::where('id', $data['idorden'])->delete();
                        return redirect()->back()->with('info', 'Problemas al general la orden, intente mas tarde');
                    }
                } else {
                    $fee = 150;
                    $data = [
                        'user_id' => Auth::id(),
                        'amount' => $request->monto,
                        'fee' => $fee,
                    ];

                    $data['idorden'] = $this->saveOrden($data);
                    $user = Auth::user();
                    $data['name'] = $user->name;
                    $data['email'] = $user->email;
                    $data['total'] = $data['amount'] + $fee;
                    $data['descripcion'] = "Inversion contrato";

                    $url = $this->generalUrlOrden($data);

                    if (!empty($url)) {
                        return redirect($url);
                    } else {
                        OrdenPurchase::where('id', $data['idorden'])->delete();
                        return redirect()->back()->with('info', 'Problemas al general la orden, intente mas tarde');
                    }
                }
            }
        } catch (\Throwable $th) {
            Log::error('Tienda - procesarOrden -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function saveOrden($data): int
    {
        $orden = OrdenPurchase::create($data);
        return $orden->id;
    }

    private function generalUrlOrden($data): string
    {
        try {

            $transaction['order_id'] = $data['idorden']; // invoice number
            $transaction['amountTotal'] = floatval($data['total']);
            $transaction['note'] = $data['descripcion'];
            $transaction['buyer_name'] = $data['name'];
            $transaction['buyer_email'] = $data['email'];
            $transaction['redirect_url'] = route('dashboard.index'); // When Transaction was comleted
            $transaction['cancel_url'] = route('shop'); // When user click cancel link
            $transaction['items'][] = [
                'itemDescription' => 'Inversion',
                'itemPrice' => (float) $data['total'], // USD
                'itemQty' => (int) 1,
                'itemSubtotalAmount' => (float) $data['total'] // USD
            ];

            $ruta = CoinPayment::generatelink($transaction);
            if ($ruta != null) {
                return $ruta;
            }
        } catch (\Throwable $th) {
            Log::error('Tienda - generalUrlOrden -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function cambiar_status(Request $request)
    {
        try {
            DB::beginTransaction();

            $orden = OrdenPurchase::findOrFail($request->id);
            $orden->status = $request->status;
            $orden->save();

            if ($request->status == '1') {

                $user = User::findOrFail($orden->user_id);
                if ($orden->type == 'reactivacion') {
                    $inversion = $user->inversionMasAlta();
                    $parents = $this->getDataFather($user, 2);
                    $parentDirecto = $this->getDataFather($user, 1);
                    if (isset($parentDirecto[0])) {

                        if ($parentDirecto[0]->nivel == 1) {
                            $level = 1;
                            $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, $level, $user);
                        } else {
                            $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, null, $user);
                        }
                    }
                } else {
                    $this->registeContract($orden);
                }

                $user->status = '1';
                $user->date_activo = Carbon::now();
                $user->save();
                event(new UserEvent($user));
            }

            DB::commit();

            return back()->with('success', 'Orden actualizada exitosamente');
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - cambiar_status -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite llamar al funcion que registra los contrato
     *
     * @param integer $idorden
     * @return void
     */
    private function registeContract($orden)
    {
        $this->InversionController->saveInversion($orden);
    }


    /*
    public function proccess(Request $request)
    {
        try {
            $user = Auth::user();
            $package = Package::findOrFail($request->idproduct);
            $orden = OrdenPurchase::create([
                'user_id' => $user->id,
                'amount' => $package->price,
                'fee' => 0,
                'package_id' => $package->id
            ]);
            return view('shop.transaction', compact('user', 'orden'));
        } catch (\Throwable $th) {
            Log::error('TiendaController - proccess -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'orden' => 'required',
            'hash' => 'required',
            'comprobante' => 'required|mimes:jpg,jpeg,png',
            'type_payment' => 'required'
        ]);
        try {
            if($validate){
                $orden = OrdenPurchase::find($request->orden);
                $orden->hash = $request->hash;
                $orden->status = '1';
                $orden->type_payment = $request->type_payment;
                if ($request->hasFile('comprobante')) {
                    $user = Auth::user();
                    $file = $request->file('comprobante');
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('storage') .'/'. $user->id.'/comprobante', $name);
                    $orden->comprobante = $name;
                }
                $orden->save();
                return redirect('/')->with('success', 'orden actualizada exitosamente');
            }
        } catch (\Throwable $th) {
            Log::error('TiendaController - store -> Error: '.$th);
            abort(500, "Ocurrio un error, contacte con el administrador");
        }
    }
    */
    public function reactivacionSaldo(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            //Cámbialo por el día de la bbdd
            $dia_inicio =  $user->date_activo;
            $data_ex =  date('y-m-d', strtotime($dia_inicio . ' + 30 days'));
            $inversiones = $user->inversiones->where('status', 1);
            $monto = 0;
            foreach ($inversiones as $inversion) {
                $monto += $inversion->invested;
            }

            $pagar = $this->montoReactivacion($monto);

            if ($user->saldoDisponible() >= $pagar) {
                $wallets = $user->getWallet->where('status', 0)->where('tipo_transaction', 0);
                foreach ($wallets as $wallet) {

                    while ($pagar > 0) {

                        $resta = $wallet->amount_fondo - $pagar;

                        if ($resta < 0) {
                            $wallet->amount_fondo = 0;
                            $wallet->status = 1;
                            $wallet->save();
                            $pagar = $resta * (-1);
                        } elseif ($resta == 0) {
                            $wallet->amount_fondo = $resta;
                            $wallet->status = 1;
                            $wallet->save();
                            $pagar = $resta;
                        } else {
                            $wallet->amount_fondo = $resta;
                            $wallet->save();
                            $pagar = 0;
                        }
                    }
                }

                DB::commit();

                return back()->with('succes', 'Reactivacion exitosa');
            } else {
                $this->reactivacion($request);
                //return redirect()->back()->with('info', 'Problemas al generar la orden, no posee saldo suficiente');
            }
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - reactivacion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function reactivacion(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();

            $inversiones = $user->inversiones->where('status', 1);
            $monto = 0;
            foreach ($inversiones as $inversion) {
                $monto += $inversion->invested;
            }

            $pagar = $this->montoReactivacion($monto);

            // if($user->ganancias() >= $monto){
            //     $inversiones = $user->inversiones->where('status', 1);
            //     $resta = $monto;
            //     foreach($inversiones as $inversion){
            //         $resta = $inversion->gain - $resta;
            //         if($resta < 0){
            //             $inversion->gain = 0;
            //             $resta = $resta * (-1);
            //         }else{
            //             $inversion->gain = $resta;
            //             $resta = 0;
            //         }
            //         $inversion->save();

            //         if($resta == 0){
            //             break;
            //         }
            //     }

            //     DB::commit();

            //     return back()->with('succes', 'Reactivacion exitosa');
            // }else{
            $fee = 0;
            $data = [
                'user_id' => $user->id,
                'amount' => $pagar,
                'fee' => $fee,
                'type' => 'reactivacion'
            ];

            $data['idorden'] = $this->saveOrden($data);
            $data['name'] = $user->name;
            $data['email'] = $user->email;
            $data['total'] = $data['amount'] + $fee;
            $data['descripcion'] = "Reactivacion";

            $url = $this->generalUrlOrden($data);

            if (!empty($url)) {
                DB::commit();
                return redirect($url);
            } else {
                OrdenPurchase::where('id', $data['idorden'])->delete();
                return redirect()->back()->with('info', 'Problemas al general la orden, intente mas tarde');
            }
            // }

        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - reactivacion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function montoReactivacion($monto)
    {
        switch ($monto) {
            case $monto >= 500 && $monto <= 5000:
                $pagar = 12;
                break;
            case $monto >= 5001 && $monto <= 15000:
                $pagar = 20;
                break;
            case $monto >= 15001 && $monto <= 30000:
                $pagar = 35;
                break;
            case $monto >= 30001 && $monto <= 50000:
                $pagar = 50;
                break;
            case $monto >= 50001 && $monto <= 150000:
                $pagar = 80;
                break;
            case $monto >= 150001 && $monto <= 300000:
                $pagar = 1000;
                break;

            default:
                $pagar = 0;
                break;
        }

        return $pagar;
    }

    public function getStatus()
    {
        $transacciones = CoinPayment::gettransactions()->select('txn_id', 'order_id')->get()->toArray();
        foreach ($transacciones as $transaccion) {
            $estado = CoinPayment::getstatusbytxnid($transaccion['txn_id']);

            $status = $estado['status'];
            if ($estado['status'] !== 0) {
                $this->change_status($transaccion['order_id'], $status);
            }
        }
    }

    public function change_status($id, $status)
    {
        try {


            DB::beginTransaction();

            $orden = OrdenPurchase::findOrFail($id);

            if ($orden->status == '0') {

                if ($status < 0) {
                    $orden->status = "2";
                    $orden->save();
                } elseif ($status > 0) {
                    $user = User::findOrFail($orden->user_id);
                    if ($orden->type == 'reactivacion') {
                        $inversion = $user->inversionMasAlta();
                        $parents = $this->getDataFather($user, 2);
                        $parentDirecto = $this->getDataFather($user, 1);
                        if (isset($parentDirecto[0])) {
                            if ($parentDirecto[0]->nivel == 1) {
                                $level = 1;
                                $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, $level, $user);
                            } else {
                                $this->InversionController->bonoRecompra($inversion->id, $parentDirecto, $inversion->invested, null, $user);
                            }
                        }
                    } else {
                        $this->registeContract($orden);
                    }

                    $orden->status = "1";
                    $orden->save();

                    $user->status = '1';
                    $user->save();
                }
            }


            DB::commit();
        } catch (\Throwable $th) {

            DB::rollback();

            Log::error('Tienda - change_status -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
    /* public function verificationCode(Request $request){

        $data =[
            'clase' => $request->clase,
            'name' => $request->name,
            'monto' => $request->data_monto,
            'activacion_manual' => $request->activacion_manual,
            'montoo' => $request->montoo,
            'wallet' => $request->wallet,
            'email' => $request->email,
            'total' => $request->total,
            'validation_code' => Str::random(10),
        ];



        return view('shop.trans', compact('data'));
    } */
}
