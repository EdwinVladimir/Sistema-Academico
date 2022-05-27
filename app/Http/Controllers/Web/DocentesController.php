<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocentesController extends Controller
{
    public function docentes(){

        return view('web.docentes');
        
    }
}
