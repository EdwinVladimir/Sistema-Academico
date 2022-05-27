<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RepartoController extends Controller
{
    public function reparto(){

        return view('web.reparto');
        
    }
}
