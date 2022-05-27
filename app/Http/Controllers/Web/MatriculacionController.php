<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MatriculacionController extends Controller
{
    public function matriculacion(){

        return view('web.matriculacion');
        
    }
}
