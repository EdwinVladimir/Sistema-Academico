<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CalificacionesController extends Controller
{
    public function calificaciones(){

        return view('web.calificaciones');
        
    }
}
