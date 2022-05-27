<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function especialidad(){

        return view('web.especialidad');
        
    }
}
