<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipogradoController extends Controller
{
    public function tipogrado(){

        return view('web.tipogrado');
        
    }
}
