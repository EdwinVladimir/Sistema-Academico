<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstudiantesController extends Controller
{
    public function estudiantes(){

        return view('web.estudiantes');
        
    }
}
