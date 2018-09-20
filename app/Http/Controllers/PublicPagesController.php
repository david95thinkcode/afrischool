<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class PublicPagesController extends Controller
{
    public function index()
    {
        return view('public/home');
    }
}
