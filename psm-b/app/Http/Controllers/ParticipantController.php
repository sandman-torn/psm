<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    //
    public function myPrograms()
    {
        $user = Auth::user();

        $programs = $user->programs()->with(['organizer'])->latest()->get(); // assuming user has relation
        return response()->json($programs);
    }
}