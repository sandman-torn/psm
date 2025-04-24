<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Participant;

class ProgramRegistrationController extends Controller
{
    public function register($id, Request $request)
    {
        \Log::info('Hit register endpoint', ['program_id' => $id, 'user_id' => optional($request->user())->id]);

        $user = $request->user();
    
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    
        // Prevent double registration
        $exists = Participant::where('user_id', $user->id)
                             ->where('program_id', $id)
                             ->exists();
    
        if ($exists) {
            return response()->json(['message' => 'Already registered'], 409);
        }
    
        $participant = Participant::create([
            'user_id' => $user->id,
            'program_id' => $id,
        ]);
    
        return response()->json([
            'message' => 'Successfully registered',
            'data' => $participant,
        ]);
    }
}
