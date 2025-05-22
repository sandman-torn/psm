<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Participant;

use Illuminate\Http\Request;

class DashboardPenganjurController extends Controller
{
    public function getPenganjurDashboardCounts()
    {
        $user = Auth::user();
        $unitId = $user->unit_id;

        $programsByUnit = Program::where('by_unit', $unitId)->count();
        $totalPrograms = Program::count();
        $totalParticipants = Participant::count(); // Adjust if you need pre-registered only

        return response()->json([
            'programs_by_unit' => $programsByUnit,
            'total_programs' => $totalPrograms,
            'total_participants' => $totalParticipants,
        ]);
    }
}
