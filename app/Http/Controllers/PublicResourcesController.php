<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PublicResourcesController extends Controller
{
    /**
     * Retourne le contenu du fichier public/js/ressources/countries.json
     */
    public function getPays()
    {
        $path = public_path('js/ressources/countries.json');
        $content;

        if (File::exists($path))  {
            $content = File::get($path);
        }
        else {
            $content = null;
        }

        return response($content)
                ->header('Content-Type', 'application/json');
        
    }
}
