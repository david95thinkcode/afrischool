<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PublicPagesController extends Controller
{
    public function index()
    {
        return redirect()->route('dashboard.home');
    }
}
