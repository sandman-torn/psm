<?php

namespace App\Http\Controllers;
use App\Models\Program;


use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function getEvents()
    {
        $programs = Program::select('id', 'program_name', 'date_from', 'date_to')->get();

        $events = $programs->map(function ($program) {
            return [
                'id' => $program->id,
                'title' => $program->program_name,
                'start' => $program->date_from,
                'end' => $program->date_to,
                'extendedProps' => [
                    // You can customize this, for now random or fixed
                    'calendar' => 'Primary',
                ],
            ];
        });

        return response()->json($events);
    }
}
