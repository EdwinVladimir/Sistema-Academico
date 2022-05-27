<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ModalidadController extends Controller
{
    public function modalidad(){

        return view('web.modalidad');
        
    }
}
