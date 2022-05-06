<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthenticationController extends Controller
{
  // Login v1
  public function login_v1()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-login-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Login v2
  public function login_v2()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-login-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Register v1
  public function register_v1()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-register-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Register v2
  public function register_v2()
  {
    $pageConfigs = ['blankPage' => true];

    return view('/content/authentication/auth-register-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Forgot Password v1
  public function forgot_password_v1()
  {
    $pageConfigs = ['blankPage' => true];
    dd($pageConfigs);
    return view('/content/authentication/auth-forgot-password-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Forgot Password v2
  public function forgot_password_v2()
  {
    $pageConfigs = ['blankPage' => true];
        
    return view('/content/authentication/auth-forgot-password-v2', ['pageConfigs' => $pageConfigs]);
  }

  // Reset Password
  public function reset_password_v1()
  {
    $pageConfigs = ['blankPage' => true];
 
    return view('/content/authentication/auth-reset-password-v1', ['pageConfigs' => $pageConfigs]);
  }

  // Reset Password
  public function reset_password_v2()
  {
    $pageConfigs = ['blankPage' => true];
 
    return view('/content/authentication/auth-reset-password-v2', ['pageConfigs' => $pageConfigs]);
  }

  public function sendVerificationEmail(){
    $user = Auth::user();

    $dataEmail = [
      'user' => $user->name,
  ];

    Mail::send('mail.VerificationEmail',  ['data' => $dataEmail], function ($msj) use ($user)
        {
            $msj->subject('Verificación de correo electrónico.');
            $msj->to($user->email);
        });  
  }
  public function verify(){

    $this->sendVerificationEmail();
    $pageConfigs = ['blankPage' => true];
    
    return view('auth.verify', ['pageConfigs' => $pageConfigs]);
  }
  public function verify_v2(){
 
    return view('auth.verified-reset');
  
  }
}
