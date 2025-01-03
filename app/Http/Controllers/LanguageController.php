<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function changeLanguage(Request $request,$lang)
    {
        session()->put('lang', $lang);
        return redirect()->back();
    }
}
