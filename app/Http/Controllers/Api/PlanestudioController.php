<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PlanestudioStoreRequest;
use App\Http\Resources\PlanestudioResource;
use App\Models\Planestudio;
use Illuminate\Http\Request;

class PlanestudioController extends Controller
{
    public function index()
    {
        return PlanestudioResource::collection(planestudio::all());
    }

    public function store(PlanestudioStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $planestudio = Planestudio::create($request->validated());

        return new PlanestudioResource($planestudio);
    }

    public function show(Planestudio $planestudio)
    {
        return new PlanestudioResource($planestudio);
    }

    public function update(Planestudio $planestudio, PlanestudioStoreRequest $request)
    {
        $planestudio->update($request->validated());
        return new PlanestudioResource(($planestudio));
    }

    public function destroy(Planestudio $planestudio)
    {
        $planestudio->delete();
        return response()->noContent();
    }

}
