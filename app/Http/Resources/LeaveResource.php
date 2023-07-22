<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nomor_induk' => $this->nomor_induk,
            'nama' => $this->nama,
            'alamat' => $this->alamat,
            'tanggal_lahir' => date('d-M-Y', strtotime($this->tanggal_lahir)),
            'tanggal_masuk' => date('d-M-Y', strtotime($this->tanggal_masuk)),
            'total_cuti' => $this->leaves_sum_lama_cuti,
        ];
    }
}
