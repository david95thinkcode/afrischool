<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PublicPagesController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            if (!Auth::user()->hasRole('authenticated'))
            {
                return Redirect::route('dashboard.home');
            }
            else
            {
                return Redirect::route('consultation.choix');
            }
        }
        else {
            return view('public/home');
        }
        
    }
}
