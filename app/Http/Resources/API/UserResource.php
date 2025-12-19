<?php

namespace App\Http\Resources\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'user' => User::find($this->id),
            'service' => $this->serv->name ?? null,
            'type' => $this->typ->name ?? null,
            'site' => $this->Sit->name ?? null,
            'grade' => $this->grad->name ?? null,
            'departement' => $this->depart->name ?? null,
            'categorie' => $this->category->name ?? null,
        ];
    }
}
