<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Docente;

use Session;

class EvaluacionesController extends Controller
{
    public function evaluaciones()
    {
        $docente = '';

        if(Session::get('usuario')->dni)
        {
            $docente = Docente::where('dni_doc', Session::get('usuario')->dni)->first();
        }

        return view('web.evaluaciones', compact('docente'));
    }
}