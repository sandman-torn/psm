<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class AttendanceController extends Controller
{
    public function storeManual(Request $request)
    {
        $validated = $request->validate([
            'program_id' => 'required|exists:programs,id',
            'date' => 'required|date',
            'attendances' => 'required|array',
            'attendances.*.participant_id' => 'required|exists:participants,id',
            'attendances.*.is_present' => 'required|boolean',
        ]);

        foreach ($validated['attendances'] as $attendance) {
            Attendance::updateOrCreate(
                [
                    'program_id' => $validated['program_id'],
                    'participant_id' => $attendance['participant_id'],
                    'date' => $validated['date'],
                ],
                [
                    'is_present' => $attendance['is_present'],
                    'recorded_by' => Auth::id(),
                    'method' => 'manual',
                ]
            );
        }

        return response()->json(['message' => 'Attendance saved successfully']);
    }

    public function getAttendanceByDate($program_id, Request $request)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $attendances = Attendance::where('program_id', $program_id)
            ->where('date', $request->date)
            ->with('participant') // optional: eager load participant info
            ->get();

        return response()->json($attendances);
    }

    public function storeManualAttendance(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        // ✅ Check if user pre-registered in participants table
        $existingParticipant = DB::table('participants')
            ->where('program_id', $request->program_id)
            ->where('user_id', $request->user_id)
            ->first();

        Log::info('Pre-registration check:', [
            'program_id' => $request->program_id,
            'user_id' => $request->user_id,
            '$existingParticipant' => $existingParticipant,
        ]);

        if (!$existingParticipant) {
            $existingParticipant = Participant::create([
                'user_id' => $request->user_id,
                'program_id' => $request->program_id,
                'is_walkin' => true,
            ]);
        }

        $method = $existingParticipant->is_walkin ? 'Walk-in' : 'Hadir';

        $attendance = Attendance::create([
            'user_id' => $request->user_id,
            'program_id' => $request->program_id,
            'date' => $request->date,
            'is_present' => true,
            'method' => $method,
        ]);



        return response()->json([
            'message' => 'Kehadiran berjaya disimpan.',
            'data' => $attendance
        ]);
    }

    public function deleteManualAttendance(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'user_id' => 'required|exists:users,id',
            'date' => 'required|date',
        ]);

        $deleted = Attendance::where([
            'program_id' => $request->program_id,
            'user_id' => $request->user_id,
            'date' => $request->date,
        ])->delete();

        if ($deleted) {
            return response()->json(['message' => 'Rekod kehadiran dipadam.']);
        } else {
            return response()->json(['message' => 'Rekod tidak dijumpai.'], 404);
        }
    }

    public function getAttendanceList(Request $request, $programId)
    {
        $date = $request->query('date');

        // Get all users who pre-registered for the program
        $preRegisteredUsers = DB::table('participants')
            ->join('users', 'participants.user_id', '=', 'users.id')
            ->where('participants.program_id', $programId)
            ->select('users.*', DB::raw('"pre-registered" as registration_type'))
            ->get();

        // Get all attendance records for the program and date
        $attendances = DB::table('attendances')
            ->where('program_id', $programId)
            ->where('date', $date)
            ->get();

        $attendanceMap = collect($attendances)->keyBy('user_id');

        $result = [];

        foreach ($preRegisteredUsers as $user) {
            $attendance = $attendanceMap->get($user->id);
            $result[] = [
                'name' => $user->name,
                'email' => $user->email,
                'ic_no' => $user->ic_no,
                'position' => $user->position,
                'department' => $user->department,
                'status' => $attendance ? $attendance->method : 'Tidak Hadir',
            ];
        }

        // Add walk-in users (not in participant table but in attendance)
        $preRegisteredIds = $preRegisteredUsers->pluck('id');
        $walkInUsers = DB::table('attendances')
            ->join('users', 'attendances.user_id', '=', 'users.id')
            ->where('attendances.program_id', $programId)
            ->where('attendances.date', $date)
            ->whereNotIn('attendances.user_id', $preRegisteredIds)
            ->select('users.*', 'attendances.method')
            ->get();

        foreach ($walkInUsers as $user) {
            $result[] = [
                'name' => $user->name,
                'email' => $user->email,
                'ic_no' => $user->ic_no,
                'position' => $user->position,
                'department' => $user->department,
                'status' => 'Walk-in',
            ];
        }

        return response()->json($result);
    }
}
