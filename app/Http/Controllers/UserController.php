<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prefix;
use App\Models\Countrie;
use App\Models\Wallet;
use App\Models\Inversion;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    public function finanzas()
    {
        $inversion = Inversion::where('user_id', Auth::id())->where('status', 1)->orderBy('invested', 'desc')->first();
        return view('financial.finanzas', compact('inversion'));
    }

    public function profile()
    {
        $invertido = $this->paquete();
        $id = Auth::user()->id;
        $user = User::find($id);
        $country = Countrie::all();
        $wallet = Wallet::where('user_id', Auth::id())->get();
        $prefix = Prefix::orderBy('id', 'asc')->get();

        return view('profile.profile',compact('country','user','wallet', 'invertido', 'prefix'));
    }

    public function kyc()
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        
        if($user->kyc == null){
           
           return view('profile.kyc', compact('user'));
        
        }elseif($user->kyc->status == 0){
            
           return redirect()->back()->with('success', 'Ya tiene una KYC en espera de ser Verificada'); 

        }elseif($user->kyc->status == 1){
          
          return redirect()->back()->with('success', 'Ya tienes una KYC Verificada');
        
        }elseif($user->kyc->status == 2){

            return view('profile.kyc', compact('user'));  
        }     
    }

    public function listUser()
    {

        $user = User::orderBy('id', 'desc')->get();

        return view('user.list-users', compact('user'));
    }

    public function start(User $user)
    {

        session()->put('impersonated_by', auth()->id());

        Auth::login($user);

        return redirect('/')->with('success', 'Has iniciado seccion en otra cuenta');
    }

    public function stop()
    {

        Auth::loginUsingId(session()->pull('impersonated_by'));

        return redirect('/')
            ->with('success', 'Has iniciado seccion con tu cuenta admin');
    }

    public function verifiedEmail()
    {
        return view('auth.email-verified');
    }


    public function verifyAccount(/* Request $request, */User $user)
    {

        /* $fields = [
            "code" => ['required', 'numeric'],
        ];

        $msj = [
            'code.required' => 'El código es requerido.',
            'code.numeric' => 'El código enviado es numérico'
        ];

        $this->validate($request, $fields, $msj); */

        /* if($request->code == $user->code_email){ */
        /* $minutos = Carbon::now()->diffInMinutes($user->code_email_date);

            if($minutos < 30){ */
        $id = Auth::user()->id;
        $user = User::find($id);
        $user->email_verified_at = Carbon::now();
        $user->save();

        return redirect()->route('verified-email')->with('alert-success', 'Tu usuario ha sido verificado con éxito.');
        /* }else{
                return redirect()->back()->with('alert-danger', 'El código está caducado, se ha enviado un nuevo código.');
            } */
        /* }else{
            return redirect()->route('user.verification.email')->with('alert-danger', 'El código ingresado no es válido. Por favor revise su correo.');
        } */
    }

    public function notificacionesLeidas()
    {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    }
    public function update(Request $request)
    {

      $user = User::find(Auth::user()->id);

      $data = $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'lastname' => ['required', 'string', 'max:255'],
        'username' => 'required',
        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id, 'id')],
        'identification_document' => ['required', 'string', 'max:255'],
        'type_document' => 'required',
        'birthdate' => 'required',
        'gender' => 'required',
      ]);

      $user->name = $data['name'];
      $user->lastname = $data['lastname'];
      $user->username = $data['username'];
      $user->email = $data['email'];
      $user->identification_document = $data['identification_document'];
      $user->birthdate = $data['birthdate'];
      $user->type_document = $data['type_document'];
      $user->gender = $data['gender'];


      $user->save();

      return back()->with('success', 'Perfil actualizado');
    }
    public function updateContacto(Request $request)
    {

        $user = User::find(Auth::user()->id);

        $request->validate([
            'phone' => 'required',
            'city' => 'required',
            'code_postal' => 'required',
            'direction' => 'required',
            'countrie' => 'required',
            'prefix' => 'required'
        ]);


        $user->phone = $request->phone;
        $user->prefix_id = $request->prefix;
        $user->countrie_id = $request->countrie;
        $user->city = $request->city;
        $user->code_postal = $request->code_postal;
        $user->direction = $request->direction;

        $user->save();

        return back()->with('success', 'Perfil actualizado');
    }
    public function photoUpdate(Request $request)
    {
         $user = User::find(Auth::user()->id);
         $request->validate([
            'photo' => 'required'
         ]);

        $user->update($request->all());

         //Guardamos foto
         $photo = $request->file('photo');
         $name = time() . "." . $photo->extension();
         $photo->move(public_path('storage') . '/photo-profile/', $name);
         $user->photo = '' . $name;

        $user->save();

        return redirect()->back()->with('success', 'La foto fue actualizada con exito');
    }
    public function PasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return back()->with('success', 'Contraseña actualizada');
    }

    public function paquete()
    {

         $paquete = "";
            $inversiones = Inversion::where('status', 1)->first();

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
}




