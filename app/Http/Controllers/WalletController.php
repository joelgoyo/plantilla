<?php

namespace App\Http\Controllers;

use App\Http\Traits\Tree;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wallet;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Rules\MatchOldPassword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;


class WalletController extends Controller
{
    //
    use Tree;

    public function bonoCartera(){
        $usuarios = User::where('status', '1')->orderBy('id', 'desc')->get();

        try{
            DB::beginTransaction();
            //Sumo los valores que tiene el usuario en su wallet
            foreach ($usuarios as $usuario){
                // dump('usuario');
                // dump($usuario);
                //dd($usuarios);
                //dd($usuario->referred_id);
                $users = $this->getChildrens($usuario, new Collection, 1)->where('nivel', 1);
                dump('directos');
                dump($users);
                foreach($users as $user){
                    if(isset($user->inversiones)){
                        foreach($user->inversiones->where('status', 1) as $inversion){
                            dump('inversion encontrada');
                            dump($inversion);

                            $wallet = Wallet::create([
                                'user_id'=> $usuario->id,
                                'referred_id' => $inversion->user_id,
                                'amount' => $inversion->capital * 0.01,
                                'amount_fondo' => $inversion->capital * 0.01,
                                'descripcion' => 'Bono Cartera',
                                'type' => 2,
                            ]);
                            dump('wallet registrada');
                            dump($wallet);
                        }
                    }
                }

            }

            DB::commit();

        }catch(\Throwable $th) {
            DB::rollback();
            Log::error('WalletController - bonoCartera -> Error: '.$th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }



    /**
     * Permite obtener el total disponible en comisiones
     *
     * @param integer $user_id
     * @return float
     */
    public function getTotalComision($user_id): float
    {
        try {
            $wallet = Wallet::where([['user_id', '=', $user_id], ['status', '=', 0]])->get()->sum('amount');
            if ($user_id == 1) {
                $wallet = Wallet::where([['status', '=', 0]])->get()->sum('amount');
            }
            return $wallet;
        } catch (\Throwable $th) {
            Log::error('Wallet - getTotalComision -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    /**
     * Permite el listado de comisiones
     *
     * @param integer $user_id
     * @return float
     */
    public function comisiones()
    {
        try {
            $wallets = Wallet::where([
            ['tipo_transaction', '=', 0],
            ['status', '!=', '3']
        ])->get();
        foreach ($wallets as $wallet) {
            $wallet->name = $wallet->getWalletUser->name;
            $wallet->referido = $wallet->getWalletReferred != null ?$wallet->getWalletReferred->name : '';
        }

        return view('reports.comision', compact('wallets'));

        } catch (\Throwable $th) {
            Log::error('Wallet - Index -> Error: ' . $th);
            abort(403, "Ocurrio un error, contacte con el administrador");
        }
    }

    public function walletCode(Request $request)
    {
        $wallet = Wallet::where([
           ['user_id', '=', Auth::id()],
        ])->first();

        return back()->with('success', 'envio exitoso');
    }
    
     public function walletOption(Request $request)
    {
        
        $data = $request->validate([
           'option' => 'required',
           'wallet' => 'required'
        ]);

        $wallet = Wallet::where('id', '=', $data['wallet'])->first();
  
        $wallet->option = $data['option'];
      
        $wallet->save();

     return back()->with('success', 'la wallet a sido actualizada con Exito');
    }

    public function edit(Request $request)
    {   
        $id = Auth::user()->id;
        $user = User::find($id); 

        if(Hash::check($request->password, $user->password)){

            $validate = $request->validate([
                'code_security' => 'required|min:6|max:6',
                'code_security_confirm' => 'required|min:6|max:6'
            ]);
            
            if ($request->code_security != $request->code_security_confirm){

                return redirect()->back()->with('danger', 'El código pin ingresado no coincide');
            }else{
                $user->code_security = $request->code_security;
                $user->save();
                return back()->with('success', 'Perfil actualizado exitosamente');
            } 

        }else{
            return redirect()->back()->with('danger', 'la contraseña no coincide.');
        }
        
    }

    public function CodigoWallet3Min():bool
    {
        $wallet = wallet::where('user_id', Auth::id())->first();
        $result = false;
        $fechaActual = Carbon::now();
        $fechaCodeCorreo = new Carbon($wallet->code_security);
        if ($fechaCodeCorreo->diffInMinutes($fechaActual) >= 3) {
            $this->CancelEdit($wallet->id, 'Tiempo limite de codigo sobrepasado');
            $result = true;
        }
        
        return $result;
    }

}
