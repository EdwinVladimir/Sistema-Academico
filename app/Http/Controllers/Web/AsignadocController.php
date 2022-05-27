<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Docente;

use Session;

class AsignadocController extends Controller
{
    public function asignadoc()
    {
        return view('web.asignadoc');
    }
}