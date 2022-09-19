<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserRes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_user' => $this->id,
            'name' => $this->name,
            'alamat' => $this->alamat,
            'email' => $this->email,
            'no_kwh' => $this->nomor_kwh,
            'id_tarif' => $this->id_tarif,
            'created_at' => $this->created_at,
            'attributes'=>[
                'level'=>[
                    'id_level'=>$this->id_level,
                    'level'=>$this->nama_level,
                ],
                'tarif'=>[
                    'id_tarif'=>$this->id_tarif,
                    'daya'=>$this->daya,
                    'tarif_perkwh'=>$this->tarif_perkwh,
                ]
            ]
        ];
    }
}
