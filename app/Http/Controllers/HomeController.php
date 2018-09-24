<?php

namespace App\Http\Controllers;

use App\Mail\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    public function index()
    {

        return view('public.contact');
    }

    public function post(Request $req)
    {

        $this->validate($req, [
            'name'=>'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'message' => 'required',
        ]);
        if(is_null($req->hpet))
        {
            $req = $req->all();
            Mail::to('info@ecolechampion.com')->send(new Contact($req));
            Flashy::success('Nous avons bien reçu votre message');
            return redirect()->route('home');
        }
    }
}
