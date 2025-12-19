<?php

namespace App\Http\Resources\API;

use App\Models\Leave;
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
            'conge' => Leave::find($this->id),
            'service' => $this->service->name,
            'departement' => $this->department->name,
            'type' => $this->type->name,
            'medias' => $this->medias,
        ];
    }
}
