<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModulosController extends Controller
{
    public function modulos(){

        return view('web.modulos');
        
    }
}
