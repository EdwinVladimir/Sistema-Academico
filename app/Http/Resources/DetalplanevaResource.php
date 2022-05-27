<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetalplanevaResource extends JsonResource
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
            'tipoact_acti' => $this->tipoact_acti,
            'descrip_detac' => $this->descrip_detac,
            'poreva_detac' => $this->poreva_detac,
            
            'planeva_id' => $this->planeva_id,   
            
            'planeva'=>$this->planevas()->get(),

        ];
    }
}
