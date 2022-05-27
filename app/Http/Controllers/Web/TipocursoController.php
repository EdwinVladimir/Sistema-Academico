<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipocursoController extends Controller
{
    public function tipocurso(){

        return view('web.tipocurso');
        
    }
}
