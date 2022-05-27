<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PeriodosController extends Controller
{
    public function periodos(){

        return view('web.periodos');
        
    }
}
