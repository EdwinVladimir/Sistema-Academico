<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Porcentaje;

use Illuminate\Http\Request;

use DB;

class PorcentajeNotaController extends Controller
{
    public function index()
    {
        $porcentaje = DB::table('porcentaje_notas')->first();

        return ['porcentaje' => $porcentaje];
    }

    public function store(Request $request)
    {
        $porcentaje = DB::table('porcentaje_notas')
                        ->where('id', 1)
                        ->update([
                                    'porcentaje_individual'  => $request->get('porcentaje_individual'),
                                    'porcentaje_grupal'      => $request->get('porcentaje_grupal'),
                                    'porcentaje_actitudinal' => $request->get('porcentaje_actitudinal')
                                ]);;

        return ['estado_accion' => true];
    }
}