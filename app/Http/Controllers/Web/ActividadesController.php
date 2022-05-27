<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Docente;

use Session;

class ActividadesController extends Controller
{
    public function actividades()
    {
        $docente = '';

        if(Session::get('usuario')->dni)
        {
            $docente = Docente::where('dni_doc', Session::get('usuario')->dni)->first();
        }
             
        return view('web.actividades', compact('docente'));
    }
}