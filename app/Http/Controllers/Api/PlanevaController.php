<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanevaStoreRequest;
use App\Http\Resources\PlanevaResource;
use App\Models\Actividad;
use App\Models\Detalacti;
use App\Models\Detalplaneva;
use App\Models\Planeva;

use Illuminate\Http\Request;

use DB;
use Validator;

class PlanevaController extends Controller
{
    public function index(Request $request)
    {
        $lista_planes = Planeva::with('detalplanevas')->where('docente_id', $request->get('docente_id'))
                                                    ->where('periodo_id', $request->get('periodo_id'))
                                                    ->where('materia_id', $request->get('materia_id'))
                                                    ->orderby('fecent_plaeva', 'asc')
                                                    ->get();

        return response(['lista_planes' => $lista_planes]);
    }

    public function store(PlanevaStoreRequest $request)
    {
        $planeva = Planeva::with('detalplanevas')->where('fecent_plaeva', $request->get('fecent_plaeva'))
                                                        ->where('docente_id', $request->get('docente_id'))
                                                        ->where('periodo_id', $request->get('periodo_id'))
                                                        ->where('materia_id', $request->get('materia_id'))
                                                        ->first();

        if($planeva)
        {
            return response(['estado_accion' => false]);
        }

        try 
        {
            DB::beginTransaction();

            $planeva = Planeva::create($request->validated());

            $detalplaneva = new Detalplaneva();

            $detalplaneva->tipoact_acti  = $request->tipoact_acti;
            $detalplaneva->planeva_id    = $planeva->id;
            $detalplaneva->descrip_detac = $request->descrip_detac;
            $detalplaneva->poreva_detac  = $request->poreva_detac;

            $detalplaneva->save();

            DB::commit();
            
            return response(['estado_accion' => true]);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response(['estado_accion' => false]);
        }
    }

    public function show(Planeva $plan, $id)
    {
        $plan = Planeva::with('detalplanevas')->find($id);

        return response(['plan' => $plan]);
    }

    public function update(Planeva $planeva, PlanevaStoreRequest $request)
    {
        /*$planeva = Planeva::with('detalplanevas')->where('fecent_plaeva', $request->get('fecent_plaeva'))
                                                        ->where('docente_id', $request->get('docente_id'))
                                                        ->where('periodo_id', $request->get('periodo_id'))
                                                        ->where('materia_id', $request->get('materia_id'))
                                                        ->first();*/

        $planeva = Planeva::find($request->get('id'));

        if($planeva)
        {
            if($planeva->id != $request->get('id'))
            {
                return response(['estado_accion' => false]);
            }
        }

        try 
        {
            DB::beginTransaction();

            $planeva->update($request->validated());

            $detalplaneva = Detalplaneva::where('planeva_id', $planeva->id)->first();

            $detalplaneva->tipoact_acti = $request->tipoact_acti;
            $detalplaneva->descrip_detac = $request->descrip_detac;
            
            $detalplaneva->save();

            DB::commit();
            
            return response(['estado_accion' => true]);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response(['estado_accion' => false]);
        }
    }

    public function destroy(Planeva $planeva)
    {
        try 
        {
            DB::beginTransaction();

            $detalplaneva = Detalplaneva::where('planeva_id', $planeva->id)->first();

            $detalplaneva->delete();
            $planeva->delete();

            DB::commit();

            return response(['estado_accion' => true]);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response(['estado_accion' => false], 400);
        }
    }
}

