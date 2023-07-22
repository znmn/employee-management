<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LeaveQuotaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // 'id' => $this->id,
            'nomor_induk' => $this->nomor_induk,
            'nama' => $this->nama,
            'sisa_cuti' => 12 - $this->leaves_count,
        ];
    }
}
