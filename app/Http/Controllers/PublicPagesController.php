<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PublicPagesController extends Controller
{
    public function index()
    {
        if (Auth::user()->hasRole('parent')) 
        {
            return Redirect::route('consultation.choix');
        }
        else 
        {
            return Redirect::route('dashboard.home');
        }
        
    }
}
