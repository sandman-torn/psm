<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramMaterial;


class ProgramMaterialController extends Controller
{
    public function index($programId)
    {
        return ProgramMaterial::where('program_id', $programId)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'program_id' => 'required|exists:programs,id',
            'material_name' => 'required|string',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,txt,xls,xlsx',
        ]);

        // Simpan fail ke dalam storage/app/public/materials
        $path = $request->file('file')->store('materials', 'public');

        $material = ProgramMaterial::create([
            'program_id' => $request->program_id,
            'material_name' => $request->material_name,
            'file_url' => $path,
        ]);

        return response()->json([
            'message' => 'Bahan berjaya dimuat naik.',
            'data' => $material
        ], 201);
    }
    public function destroy($id)
    {
        $material = ProgramMaterial::findOrFail($id);

        // padam fail dari storage dulu
        if (\Storage::disk('public')->exists($material->file_url)) {
            \Storage::disk('public')->delete($material->file_url);
        }

        // padam rekod dalam db
        $material->delete();

        return response()->json([
            'message' => 'Bahan berjaya dipadam.'
        ]);
    }
}