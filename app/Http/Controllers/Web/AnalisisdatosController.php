<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnalisisdatosController extends Controller
{
    public function analisisdatos(){

        return view('web.analisisdatos');
        
    }
}
