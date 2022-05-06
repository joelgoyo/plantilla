<?php

namespace App\Http\Controllers;

use App\Models\kyc;
use App\Models\User;
use App\Models\Inversion;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class KycController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $kyc = Kyc::OrderBy('id', 'desc')->get();

        return view('kyc.index', compact('kyc'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $kyc = request()->validate([
            'user_id' => 'required',
            'type_kyc' => 'required',
            'photo_forward' => 'required|image',
            'photo_rear' => 'required|image',
        ]);
  
        $kyc = new kyc();
        $kyc->user_id = $request->user_id;
        $kyc->type_kyc = $request->type_kyc;
        $kyc->photo_forward = $request->photo_forward;
        $kyc->photo_rear = $request->photo_rear;

        //Guardamos foto frontal
        $photo_forward = $request->file('photo_forward');
        $name = time() . "." . $photo_forward->extension();
        $photo_forward->move(public_path('storage') . '/photo-kyc/frontal', $name);
        $kyc->photo_forward = '' . $name;

        //Guardamos foto trasera
        $photo_rear = $request->file('photo_rear');
        $name = time() . "." . $photo_rear->extension();
        $photo_rear->move(public_path('storage') . '/photo-kyc/trasera', $name);
        $kyc->photo_rear = '' . $name;

        $kyc->save();

        return redirect()->route('profile.profile')->with('success', 'La Kyc fue creada con exito');
       
    }
    
    public function update(Request $request ,  Kyc $kyc)
    {
     
        $user = Auth::user();
        $kyc = Kyc::find($request->id);
 
        $data = request()->validate([
            'user_id' => 'required',
            'status' => 'required',
            'type_kyc' => 'required',
            'photo_forward' => 'required|image',
            'photo_rear' => 'required|image',
        ]);
      
        $kyc->user_id = $data['user_id'];
        $kyc->status = $data['status'];
        $kyc->type_kyc = $data['type_kyc'];
        $kyc->photo_forward = $data['photo_forward'];
        $kyc->photo_rear = $data['photo_rear'];
        

        //Guardamos foto frontal
       $photo_forward = $request->file('photo_forward');
       $name = time() . "." . $photo_forward->extension();
       $photo_forward->move(public_path('storage') . '/photo-kyc/frontal', $name);
       $kyc->photo_forward = '' . $name;

        //Guardamos foto trasera
       $photo_rear = $request->file('photo_rear');
       $name = time() . "." . $photo_rear->extension();
       $photo_rear->move(public_path('storage') . '/photo-kyc/trasera', $name);
       $kyc->photo_rear = '' . $name;
            
       $kyc->save();
   

        return redirect()->route('profile.profile')->with('success', 'La Kyc fue Actualizada con exito');
    }
    public function cambiarStatusKyc(Request $request)
    {
        DB::beginTransaction();

        $kyc = kyc::findOrFail($request->id);
        $kyc->status = $request->status;
        // dd($kyc);
        $kyc->save();

        DB::commit();

        return redirect()->back()->with('success', 'La kyc fue revisada con exito');
    }
}
