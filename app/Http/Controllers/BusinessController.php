<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\Rentabilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Log_rentabilidad;

class BusinessController extends Controller
{
    // Inversiones
    public function inversiones()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $inversiones = Inversion::orderBy('id', 'desc')->get();
        }else{
            $inversiones = Inversion::orderBy('id', 'desc')->where('user_id', $user->id)->get();
        }

        return view('business.invest', compact('inversiones'));
    }

    //Rentabilidad
    public function rentabilidad()
    {
        $user = auth()->user();
     
        if($user->admin == 1){
            $rentabilidades = Log_rentabilidad::orderBy('id', 'desc')->get();
        }else{
            $rentabilidades = Log_rentabilidad::orderBy('id', 'desc')->whereHas('inversion', function($inversion)use($user){
                $inversion->where('user_id', $user->id);
            })->get();
        }

        return view('business.rentabilidad', compact('rentabilidades'));
    }
}
