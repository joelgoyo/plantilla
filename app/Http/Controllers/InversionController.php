<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inversion;
use DB;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Http\Traits\Tree;
use App\Models\Wallet;
use App\Models\Rentabilidad;
use App\Models\PorcentajeRentabilidad;
use Illuminate\Support\Carbon;
use App\Models\Log_rentabilidad;
use Illuminate\Support\Facades\Auth;
use App\Models\Liquidaction;
use App\Models\OrdenPurchase;

class InversionController extends Controller
{
    use Tree;
    //

    public function retiroCapital()
    {
        $user = Auth::user();
        $inversiones = [];
        if (isset($user->inversiones)) {
            $inversiones = $user->inversiones->where('status', 1);
        }

        return view('retiros.index', compact('inversiones'));
    }

    public function solicitar(Request $request)
    {
        try {
            $inversion = Inversion::findOrFail($request->inversionId);

            $validate = $request->validate([
                'inversionId' => 'required',
                'amount' => 'required'
            ]);

            if ($validate) {
                $Inversion = Inversion::findOrFail($request->inversionId);
                $Inversion->capital -= $request->amount;
                $Inversion->save();
                /* $solicitud = SolicitudRetiro::create([
                    'contracts_id' => $request->contratoId,
                    'amount' => $request->amount,
                    'percentage' => 5,
                    'status' => 0
                ]); */
                return response()->json(true);
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - solicitar -> Error: ' . $th);
            abort(403, "Ocurrió un error, contacte con el administrador");
        }
    }
    public function generarLiquidacion(Request $request)
    {

        $validate = $request->validate([
            'inversionId' => 'required',
            'amount' => 'required',
            'wallet' => 'required',

        ]);

        try {
            if ($validate) {
                $bruto = $request->amount;
                $feed = ($bruto * 0.05);
                $total = $bruto - $feed;
                $user = Auth::user();

                $arrayLiquidation = [
                    'iduser' => $user->id,
                    'total' => $total,
                    'monto_bruto' => $bruto,
                    'feed' => $feed,
                    'hash',
                    'inversion_id' => $request->inversionId,
                    'wallet_used' => $request->wallet,
                    'status' => 0,
                    'type' => 1, //Retiro de capital
                    'code_correo' => null,
                    'fecha_code' => Carbon::now()
                ];

                $liquidacion = Liquidaction::create($arrayLiquidation);
            }
        } catch (\Throwable $th) {
            Log::error('InversionController - saveInversion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
        return $liquidacion->id;
    }


    /* public function cancelar(Request $request)
    {
        SolicitudRetiro::find($request->solicitudId)->update(['status' => 2]);
        return response()->json(true);
    } */
    public function saveInversion($orden)
    {
        try {
            DB::beginTransaction();

            $data = [
                'orden_purchases_id' => $orden->id,
                'user_id' => $orden->user_id,
                'invested' => $orden->amount,
                'capital' => $orden->amount,
            ];
            $contrato = Inversion::create($data);
            $idContrato = $contrato->id;
            $user = User::find($orden->user_id);
            $parents = $this->getDataFather($user, 2);

            $user_id = $contrato->user_id;
            $invest = Inversion::where('user_id', '=', $user_id)->count('id');
            if ($invest > 1) {
                if (isset($parents)) {
                    foreach ($parents as $parent) {
                        $amount = 0;
                        if ($parent->nivel == 1) {
                            $amount = 0;
                            $this->bonoInicio($idContrato, $parent, $amount, $user);
                        } elseif ($parent->nivel == 2) {
                            $amount = 0;
                            $this->bonoInicio($idContrato, $parent, $amount, $user);
                        }
                        $contrato->save();
                    }
                }
            } else {
                if (isset($parents)) {
                    foreach ($parents as $parent) {
                        $amount = 0;
                        if ($parent->nivel == 1) {
                            $amount = 50;
                            $this->bonoInicio($idContrato, $parent, $amount, $user);
                        } elseif ($parent->nivel == 2) {
                            $amount = 20;
                            $this->bonoInicio($idContrato, $parent, $amount, $user);
                        }
                        $contrato->save();
                    }
                }
            }


            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - saveInversion -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }


    public function bonoInicio($inversion, $user, $amount, $child)
    {
        $wallet = Wallet::create([
            'user_id' => $user->id,
            'referred_id' => $child->id,
            'inversion_id' => $inversion,
            'amount' => $amount,
            'amount_fondo' => $amount,
            'descripcion' => 'Bono Inicio nivel ' . $user->nivel,
            'type' => ($user->nivel == 1 ? 0 : $user->nivel == 2) ?  6 : 0,
        ]);
    }

    public function bonoRecompra($idContrato, $user, $amount, $level = null, $referred)
    {

        $usuario = $user[0];

        if ($level != null && $level == 1) {
            if (($amount >= 500) &&
                ($amount <= 5000)
            ) {
                $recompra = 4;
            } elseif (($amount >= 5001) &&
                ($amount <= 15000)
            ) {
                $recompra = 7;
            } elseif (($amount >= 15001) &&
                ($amount <= 30000)
            ) {
                $recompra = 12;
            } elseif (($amount >= 30001) &&
                ($amount <= 50000)
            ) {
                $recompra = 17;
            } elseif (($amount >= 50001) &&
                ($amount <= 150000)
            ) {
                $recompra = 27;
            } elseif (($amount >= 150001) &&
                ($amount <= 300000)
            ) {
                $recompra = 32;
            } else {
                $recompra = 0;
            }
        } else {
            if (($amount >= 500) &&
                ($amount <= 5000)
            ) {
                $recompra = 4;
            } elseif (($amount >= 5001) &&
                ($amount <= 15000)
            ) {
                $recompra = 7;
            } elseif (($amount >= 15001) &&
                ($amount <= 30000)
            ) {
                $recompra = 12;
            } elseif (($amount >= 30001) &&
                ($amount <= 50000)
            ) {
                $recompra = 17;
            } elseif (($amount >= 50001) &&
                ($amount <= 150000)
            ) {
                $recompra = 27;
            } elseif (($amount >= 150001) &&
                ($amount <= 300000)
            ) {
                $recompra = 32;
            } else {
                $recompra = 0;
            }
        }


        $this->saveBonoRecompra($idContrato, $usuario, $recompra, $referred);
    }

    public function saveBonoRecompra($inversion, $user, $amount, $referred)
    {
        Wallet::create([
            'user_id' => $user->id,
            'referred_id' => $referred->id,
            'inversion_id' => $inversion,
            'amount' => $amount,
            'amount_fondo' => $amount,
            'descripcion' => 'Bono Recompra',
            'type' => 1,
        ]);

        $inversion = Inversion::find($inversion);
        // $inversion->gain+= $amount;
        $inversion->save();
    }

    public function rentabilidad()
    {
        $rentabilidades = Rentabilidad::orderBy('id', 'desc')->get();

        return view('inversion.rentabilidad', compact('rentabilidades'));
    }

    public function porcentajeRentabilidad(Request $request)
    {
        $porcentaje = ($request->porcentaje / 100);

        PorcentajeRentabilidad::create([
            'porcentaje' => $porcentaje,
        ]);

        return back()->with('success', 'porcentaje actualizado exitosamente');
    }

    public function pagarRentabilidad()
    {
        try {
            DB::beginTransaction();

            $porcentaje = PorcentajeRentabilidad::orderBy('id', 'desc')->first();

            if (!isset($porcentaje)) {
                return redirect()->route('rentabilidad')->with('status', 'No se ha especificado un porcentaje de rentabilidad');
            } else{
                $porcentaje = ($porcentaje->porcentaje / 20);

                $porcentajes = collect();

                for ($i = -0.10; $i <= 0.10; $i = $i + 0.01) {
                    $valor = $porcentaje + ($porcentaje * $i);
                    $porcentajes->push($valor);
                    //dump($valor);
                }

                $porcentajeRandom = $porcentajes->random();

                $porcentaje = $porcentajeRandom;


                $ids = [];
                $gain = 0;

                $inversiones = Inversion::where([['status', '=', 1], ['pay_rentabilidad', '=', 2]])->whereHas('orden.user', function ($user) use ($ids) {
                })->get();
                $today = Carbon::now();
                $amount = 0;
                //if (($today->isMonday()) || ($today->isTuesday()) || ($today->isWednesday()) || ($today->isThursday()) || ($today->isFriday())) {
                $sumaRentabilidad = 0;
                $rentabilidad = new Rentabilidad;
                $rentabilidad->gain = 0;
                $rentabilidad->percentage = $porcentaje;
                $rentabilidad->payment_date = Carbon::now();
                $rentabilidad->status = 0;
                $rentabilidad->save();
                foreach ($inversiones as $inversion) {
                    $previoues_capital = $inversion->capital;
                    $wallet = new Wallet;
                    $wallet->user_id = $inversion->user_id;
                    $wallet->inversion_id = $inversion->id;
                    $wallet->amount = $inversion->capital * $porcentaje;
                    $wallet->amount_fondo = $inversion->capital * $porcentaje;
                    $wallet->percentage = $porcentaje;
                    $wallet->type = 5;
                    $wallet->descripcion = "Pago Rentabilidad";
                    $wallet->save();

                    //$rentabilidadGanancias =  Wallet::where('inversion_id', $inversion->id)->where('type', '!=' , 5)->orderBy('id')->get();

                    $sumaRentabilidad += $inversion->capital * $porcentaje;
                    //}



                    $gain = $inversion->capital * $porcentaje;
                    $inversion->gain += $inversion->capital * $porcentaje;
                    $inversion->save();

                    $current_capital = $inversion->capital;


                    $log_rentabilidad = new Log_rentabilidad;
                    $log_rentabilidad->rentabilidad_id = $rentabilidad->id;
                    $log_rentabilidad->inversion_id = $inversion->id;
                    $log_rentabilidad->wallet_id = $wallet != null ? $wallet->id : null;
                    $log_rentabilidad->percentage = $porcentaje;
                    $log_rentabilidad->amount = $wallet->amount;
                    $log_rentabilidad->payment_date = $today;
                    $log_rentabilidad->previoues_capital = $previoues_capital;
                    $log_rentabilidad->current_capital = $current_capital;
                    $log_rentabilidad->save();

                    $amount += $wallet->amount;

                    $ids[] = $log_rentabilidad->id;
                }

                // }

                $rentabilidad->gain = $sumaRentabilidad;
                $rentabilidad->update();
            }
            DB::commit();
            //return ['ids' => $ids, 'gain' => $gain];
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - pagarRentabilidad -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function rentabilidadSumCapital()
    {
        try {

            DB::beginTransaction();
            $wallets = Wallet::where('tipo_transaction', 0)->where('status', 0)->where('type', 5)->get();

            foreach ($wallets as $wallet) {
                $inversion = $wallet->inversion;
                $inversion->capital += $wallet->amount;
                $inversion->save();
                $wallet->status = 1;
                $wallet->save();
            }

            DB::commit();
            //return ['ids' => $ids, 'gain' => $gain];
        } catch (\Throwable $th) {
            DB::rollback();
            Log::error('InversionController - rentabilidadSumCapital -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }
}
