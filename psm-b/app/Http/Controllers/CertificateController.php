<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;
use App\Models\Program;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Str;
//use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;
use App\Models\Participant;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelHigh;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Label\Font\NotoSans;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevel;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;
use BaconQrCode\Renderer\Image\GdImageBackEnd;  // add this
use chillerlan\QRCode\QROptions;
use chillerlan\QRCode\QRCode;
use Illuminate\Support\Facades\Storage;







class CertificateController extends Controller
{
    public function downloadCertificate($programId)
    {
        $user = Auth::user();
        $program = Program::findOrFail($programId);
        $participant = $program->participants()->where('user_id', $user->id)->first();

        if (!$participant) {
            return response()->json(['message' => 'Anda tidak berdaftar untuk program ini.'], 403);
        }

        // Generate certificate code if needed
        if (!$participant->certificate_code) {
            $participant->certificate_code = 'SJL-' . strtoupper(Str::random(10));
            $participant->save();
        }

        // Data to encode in QR (e.g., a verification link or certificate code)
        $data = url('http://psm-b.test:5173/verify-certificate/' . $participant->certificate_code); // ✅ <--- define $data here

        // Set QR code options
        $options = new QROptions([
            'outputType' => QRCode::OUTPUT_IMAGE_PNG,
            'eccLevel' => QRCode::ECC_L,
            'scale' => 5,
        ]);

        // Generate base64 image
        $qrBase64 = (new QRCode($options))->render($data); // base64 format like: data:image/png;base64,...

        // Strip the header
        $base64Image = str_replace('data:image/png;base64,', '', $qrBase64);

        // Decode base64 to binary
        $imageData = base64_decode($base64Image);

        // Save PNG file to storage
        $filename = 'qr/' . $participant->certificate_code . '.png';
        Storage::disk('public')->put($filename, $imageData);

        // Prepare for blade/pdf view
        $qrImagePath = public_path('storage/' . $filename);


        // Generate PDF
        $pdf = Pdf::loadView('certificate', [
            'participant' => $participant,
            'program' => $program,
            'qrImagePath' => $qrImagePath,
        ])->setPaper('A4', 'landscape');

        return $pdf->download("sijil-{$participant->name}.pdf");
    }
    public function checkEligibility($programId)
    {
        $userId = Auth::id();

        $program = Program::findOrFail($programId);
        $totalDays = Carbon::parse($program->date_from)
            ->diffInDays(Carbon::parse($program->date_to)) + 1;

        // Kira jumlah hari yang user hadir
        $attendedDays = Attendance::where('program_id', $programId)
            ->where('user_id', $userId)
            ->whereIn('method', ['hadir', 'walk-in'])
            ->distinct('date')
            ->count('date');

        // Layak hanya jika had attendance = bilangan hari program
        $isEligible = ($attendedDays == $totalDays && $attendedDays > 0);

        return response()->json([
            'eligible' => $isEligible,
            'attendedDays' => $attendedDays,
            'totalDays' => $totalDays,
        ]);
    }

    public function verifyCertificate($code)
    {
        $participant = Participant::where('certificate_code', $code)->first();

        if (!$participant) {
            return response()->json(['message' => 'Sijil ini TIDAK SAH. <br> No Sijil tidak dijumpai dalam Senarai Sijil Jabatan ini.'], 404);
        }

        $user = $participant->user;
        $program = $participant->program;

        return response()->json([
            'valid' => true,
            'name' => $user->name,
            'ic_no' => $user->ic_no,
            'program_name' => $program->program_name,
            'location' => $program->location,
            'date_from' => Carbon::parse($program->date_from)->format('d M Y'),
            'date_to' => Carbon::parse($program->date_to)->format('d M Y'),
        ]);
    }
}
