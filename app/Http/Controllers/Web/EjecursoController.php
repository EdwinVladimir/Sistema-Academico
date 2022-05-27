<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EjecursoController extends Controller
{
    public function ejecurso(){

        return view('web.ejecurso');
        
    }
}
