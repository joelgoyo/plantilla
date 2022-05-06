<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    public function swap($locale)
    {
       
        $availLocale = ['en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt', 'es' => 'es'];
       
        if (array_key_exists($locale, $availLocale)) {
            session()->put('locale', $locale);
        }

        return response()->json($locale);
        
    }
}
