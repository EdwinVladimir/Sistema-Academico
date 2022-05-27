<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalirController extends Controller
{
    public function salir(){

        return view('web.salir');
        
    }
}
