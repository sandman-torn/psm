<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProgramResource;
use App\Models\Attendance;
use App\Models\Participant;
use Illuminate\Support\Facades\Log;



class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programs = Program::with(['creator', 'unit'])->get();
        return ProgramResource::collection($programs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'program_name' => 'required|string|max:255',
            'program_desc' => 'required|string',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'location' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'materials' => 'nullable|array',
            'time_from' => 'nullable|date_format:H:i',
            'time_to' => 'nullable|date_format:H:i',
        ]);

        $data = [
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc,
            'date_to' => $request->date_to,
            'date_from' => $request->date_from,
            //'date_from' => Carbon::parse($request->date_from)->format('Y/m/d'),
            //'date_to' => Carbon::parse($request->date_to)->format('Y/m/d'),
            'location' => $request->location,
            'url' => $request->url,
            'created_by' => Auth::id(),
            'by_unit' => Auth::user()->unit_id, // ✅ this will now be just the unit string
            'time_to' => $request->time_to,
            'time_from' => $request->time_from,
        ];


        $program = Program::create($data);

        if ($request->has('materials')) {
            foreach ($request->materials as $material) {
                $program->materials()->create($material);
            }
        }

        return response()->json($program->load('materials'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $program = Program::with(['creator', 'unit'])
            ->withCount([
                'participants as registered_participants_count' => function ($query) {
                    $query->where('is_walkin', false);
                },
                'participants as walkin_participants_count' => function ($query) {
                    $query->where('is_walkin', true);
                },
            ])
            ->findOrFail($id);

        return new ProgramResource($program);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'program_name' => 'required|string',
            'program_desc' => 'nullable|string',
            'date_from' => 'required|date',
            'date_to' => 'required|date|after_or_equal:date_from',
            'location' => 'nullable|string',
            'url' => 'nullable|string',
            'created_by' => 'required|integer|exists:users,id',
            'by_unit' => 'required|integer|exists:units,id',
            'time_from' => 'nullable|date_format:H:i:s',
            'time_to' => 'nullable|date_format:H:i:s',
        ]);

        $program = Program::findOrFail($id);

        $program->update([
            'program_name' => $request->program_name,
            'date_to' => $request->date_to,
            'date_from' => $request->date_from,
            // 'date_from' => Carbon::parse($request->date_from)->format('Y/m/d'),
            // 'date_to' => Carbon::parse($request->date_to)->format('Y/m/d'),
            'location' => $request->location,
            'url' => $request->url,
            'created_by' => $request->created_by,
            'by_unit' => $request->by_unit,
            'time_to' => $request->time_to,
            'time_from' => $request->time_from,
        ]);

        return response()->json($program);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $program = Program::findOrFail($id);
        $program->delete();
        return response()->noContent();
    }

    public function indexPesertaPrograms()
    {
        $user = Auth::user();

        // Pastikan user ada relation "programs"
        $programs = $user->programs()->with(['creator', 'unit'])->latest()->get();


        return ProgramResource::collection($programs);
    }

    public function getParticipants($id)
    {
        $program = Program::with(relations: 'participants.user')->findOrFail($id);

        return response()->json($program->participants);
    }

    public function attendanceSummary(Request $request, $programId)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        $date = $request->date;

        // Get all participants (pre-registered)
        $participantUserIds = Participant::where('program_id', $programId)->pluck('user_id');

        // Count hadir
        $hadir = Attendance::where('program_id', $programId)
            ->where('date', $date)
            ->where('method', 'Hadir')
            ->count();

        // Count walk-in
        $walkin = Attendance::where('program_id', $programId)
            ->where('date', $date)
            ->where('method', 'Walk-in')
            ->count();

        // Count tidak hadir = total pre-registered - hadir
        $tidakHadir = $participantUserIds->count() - ($hadir + $walkin);

        // Add logs to check values
        Log::info('Attendance summary', [
            'program_id' => $programId,
            'date' => $date,
            'participant_user_ids' => $participantUserIds,
            'hadir' => $hadir,
            'walkin' => $walkin,
            'tidak_hadir' => $tidakHadir,
        ]);

        return response()->json([
            'hadir' => $hadir,
            'tidak_hadir' => $tidakHadir,
            'walkin' => $walkin,
        ]);
    }

    public function toggleCertificate($id)
    {
        $program = Program::findOrFail($id);

        // Toggle isCertificate: if 1 -> 0, if 0 -> 1
        $program->isCertificate = !$program->isCertificate;
        $program->save();

        return response()->json([
            'message' => 'Status sijil dikemaskini.',
            'isCertificate' => $program->isCertificate
        ]);
    }
}
