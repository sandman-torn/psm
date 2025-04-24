<?php

namespace App\Http\Resources;
use Carbon\Carbon;


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

            // Format the date to "24/04/2025"
            'date_from' => Carbon::parse($this->date_from)->format('d/m/Y'),
            'date_to' => Carbon::parse($this->date_to)->format('d/m/Y'),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'url' => $this->url,
            'participants_count' => $this->participants_count, // 👈 Add this


            // 👇 Transformed fields


            'created_by' => $this->created_by, // return id
            'created_by_name' => optional($this->creator)->name, // for display
            'by_unit' => $this->by_unit, // return id
            'by_unit_name' => optional($this->unit)->unit, // for display
        ];
    }
}
