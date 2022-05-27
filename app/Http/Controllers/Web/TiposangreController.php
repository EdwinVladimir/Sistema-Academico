<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TiposangreController extends Controller
{
    public function tiposangre(){

        return view('web.tiposangre');
        
    }
}
