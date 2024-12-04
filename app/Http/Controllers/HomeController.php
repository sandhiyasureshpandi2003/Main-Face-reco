<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        if (Auth::check()) {            
            $user = auth()->user();
          return view('home', compact('user'));
           //return view('testhome', compact('user'));

        }
    }
    public function user_profile(){
        if (Auth::check()) {  
            $user = Auth::user();
            return view('profile', compact('user'));
        }
    }
}
