<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Models\Porcentaje;

use Illuminate\Http\Request;

use DB;

class ReportePieController extends Controller
{
    public function index()
    {
        $pie_reporte = DB::table('pie_reporte')->get();

        return ['pie_reporte' => $pie_reporte];
    }

    public function show(Request $request)
    {
        $pie_reporte = DB::table('pie_reporte')
                            ->where('id', $request->get('id'))
                            ->update([
                                    'nombre_completo'  => $request->get('nombre_completo'),
                                    'grado'      => $request->get('grado'),
                                    'cargo' => $request->get('cargo')
                                ]);;

        return ['estado_accion' => true];
    }
}