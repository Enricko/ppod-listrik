<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Database\Eloquent\Collection;

class TagihanRes extends JsonResource
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
            'id_tagihan' => $this->id_tagihan,
            'bulan' => $this->bulan,
            'tahun' => $this->tahun,
            'jumlah_meter' => $this->jumlah_meter,
            'status' => $this->status,
            'attributes' =>[
                'user'=>[
                    'id_user'=>$this->id,
                    'nama'=>$this->name,
                    'alamat'=>$this->alamat,
                    'email'=>$this->email,
                    'nomor_kwh'=>$this->nomor_kwh,
                    'tarif'=>[
                        'id_tarif'=>$this->id_tarif,
                        'daya'=>$this->id_tarif == 1 ? '< 900 VA' : '1.300 VA - 4.400 VA',
                        'tarif_perkwh'=>$this->id_tarif == 1 ? '1352' : '1467',
                    ],
                ],
                'penggunaan'=>[
                    'id_tagihan'=>$this->id_tagihan,
                    'meter_awal'=>$this->meter_awal,
                    'meter_akhir'=>$this->meter_akhir,
                ],
            ],
        ];
    }
}
