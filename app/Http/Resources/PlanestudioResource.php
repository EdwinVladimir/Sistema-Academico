<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlanestudioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
        'id' => $this->id,    
        'tit_pla' => $this->tit_pla,
        'descrip_pla' => $this->descrip_pla,
        'curso_id' => $this->curso_id,
        'archi_pla' => $this->archi_pla,
        ];
    }
}
