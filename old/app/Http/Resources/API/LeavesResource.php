<?php

namespace App\Http\Resources\API;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LeavesResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function($data) {
            return [
                'conge' => $data,
                'service' => $data->service->name ?? null,
                'departement' => $data->department->name ?? null,
                'type' => $data->type->name ?? null,
                'medias' => $data->medias,
            ];
        });
    }
}
