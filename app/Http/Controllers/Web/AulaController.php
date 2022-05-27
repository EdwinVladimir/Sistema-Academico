<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AulaController extends Controller
{
    public function aula(){

        return view('web.aula');
        
    }
}
