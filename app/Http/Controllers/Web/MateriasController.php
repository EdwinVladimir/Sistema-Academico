<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    public function materias(){

        return view('web.materias');
        
    }
}
