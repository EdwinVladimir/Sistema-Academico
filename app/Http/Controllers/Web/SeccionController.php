<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    public function seccion(){

        return view('web.seccion');
        
    }
}
