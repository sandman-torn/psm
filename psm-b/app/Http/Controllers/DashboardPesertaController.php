<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;

use Illuminate\Http\Request;

class DashboardPesertaController extends Controller
{
    public function getPesertaDashboardData()
{
    $userId = auth()->id();
    $today = now()->toDateString();

    $registeredPrograms = Participant::where('user_id', $userId)->count();

    $incomingPrograms = Participant::where('user_id', $userId)
        ->whereHas('program', function ($query) use ($today) {
            $query->whereDate('date_from', '>=', $today);
        })->count();

    $completedPrograms = Participant::where('user_id', $userId)
        ->whereHas('program', function ($query) use ($today) {
            $query->whereDate('date_to', '<', $today);
        })->count();

    return response()->json([
        'registered' => $registeredPrograms,
        'incoming' => $incomingPrograms,
        'completed' => $completedPrograms,
    ]);
}
}
