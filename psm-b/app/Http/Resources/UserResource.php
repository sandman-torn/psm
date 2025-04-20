<?php

namespace App\Http\Resources;

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
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "ic_no" => $this->ic_no,
            "position" => $this->position,
            "department" => $this->department,
            "unit_id" => $this->unit_id,
            "unit" => $this->unit ? $this->unit->unit : null, // <- Add this line
            "phone_no" => $this->phone_no,
            'roles' => $this->roles->pluck('role'), // or ->pluck('role') if column is `role`

        ];
    }
}
