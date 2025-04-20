<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
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
            'program_name' => $this->program_name,
            'program_desc' => $this->program_desc,
            'location' => $this->location,
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'url' => $this->url,

            // 👇 Transformed fields


            'created_by' => $this->created_by, // return id
            'created_by_name' => $this->creator->name, // for display
            'by_unit' => $this->by_unit, // return id
            'by_unit_name' => $this->unit->unit, // for display
        ];
    }
}
