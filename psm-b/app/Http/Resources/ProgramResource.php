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
            'date_from' => $this->date_from, // bagi raw format dari DB
            'date_to' => $this->date_to,
            'date_from_display' => Carbon::parse($this->date_from)->format('d/m/Y'),
            'date_to_display' => Carbon::parse($this->date_to)->format('d/m/Y'),

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'url' => $this->url,
            'registered_participants_count' => $this->registered_participants_count,
            'walkin_participants_count' => $this->walkin_participants_count,
            'isCertificate' => $this->isCertificate,
            'time_from' => $this->time_from,
            'time_to' => $this->time_to,
            'time_from_display' => Carbon::createFromFormat('H:i:s', $this->time_from)->format('g:i A'),
            'time_to_display' => Carbon::createFromFormat('H:i:s', $this->time_to)->format('g:i A'),

            // 👇 Transformed fields


            'created_by' => $this->created_by, // return id
            'created_by_name' => optional($this->creator)->name, // for display
            'by_unit' => $this->by_unit, // return id
            'by_unit_name' => optional($this->unit)->unit, // for display
        ];
    }
}
