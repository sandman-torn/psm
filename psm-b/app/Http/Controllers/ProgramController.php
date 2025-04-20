<?php

namespace App\Http\Controllers;
use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Models\Program;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProgramResource;


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
        ]);

        $data = [
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc,
            'date_from' => Carbon::parse($request->date_from)->format('Y-m-d H:i:s'),
            'date_to' => Carbon::parse($request->date_to)->format('Y-m-d H:i:s'),
            'location' => $request->location,
            'url' => $request->url,
            'created_by' => Auth::id(),
            'by_unit' => Auth::user()->unit_id, // ✅ this will now be just the unit string
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
        $program = Program::with(['creator', 'unit'])->findOrFail($id);
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
        ]);

        $program = Program::findOrFail($id);

        $program->update([
            'program_name' => $request->program_name,
            'program_desc' => $request->program_desc,
            'date_from' => Carbon::parse($request->date_from)->format('Y-m-d H:i:s'),
            'date_to' => Carbon::parse($request->date_to)->format('Y-m-d H:i:s'),
            'location' => $request->location,
            'url' => $request->url,
            'created_by' => $request->created_by,
            'by_unit' => $request->by_unit,
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
}
