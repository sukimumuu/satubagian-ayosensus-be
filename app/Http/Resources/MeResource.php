<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MeResource extends JsonResource
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
            'name' => $this->name,
            'role' => $this->getRoleNames(),
            'first_name' => $this->first_name ?? null,
            'middle_name' => $this->middle_name ?? null,
            'last_name' => $this->last_name ?? null,
            'kode_desa' => $this->kode_desa ?? null,
            'nik' => $this->nik ?? null,
            'phone' => $this->phone ?? null,
        ];
    }
}
