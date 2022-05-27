<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PeriodoResource extends JsonResource
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
            'ano_per' => $this->ano_per,
            'peri_per' => $this->peri_per,
            'finic_per' => $this->finic_per,
            'ffin_per' => $this->ffin_per,
            'estado' => $this->estado,
        ];
    }
}
