<?php

namespace App\Http\Controllers;

use App\Models\OrdenPurchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;


class ReportController extends Controller
{
  
    public function ordenes()
    {
        $user = auth()->user();
        if($user->admin == 1){
            $ordenes = OrdenPurchase::orderBy('id', 'desc')->get();
    
        }else{
            $ordenes = OrdenPurchase::orderBy('id', 'desc')->where('user_id', $user->id)->get();
        }
        
        return view('reports.index', compact('ordenes'));
    }

    public function indexShow($id){
  
     $contrato = contract::find($id);

     return view('reports.show-contrato')->with('contrato', $contrato);
    }
}

