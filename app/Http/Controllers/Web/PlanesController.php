<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PlanesController extends Controller
{
    public function planes(){

        return view('web.planes');
        
    }
}
