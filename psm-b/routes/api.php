<?php

use App\Http\Controllers\Auth\PentadbirLoginController;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramRegistrationController;
use App\Http\Controllers\ParticipantController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Api\UserStatsController;
use App\Http\Controllers\DashboardPenganjurController;
use App\Http\Controllers\DashboardPesertaController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\ProgramMaterialController;





Route::get('/public-verify-certificate/{code}', [CertificateController::class, 'verifyCertificate']);


Route::get('/user', function (Request $request) {
    return UserResource::make($request->user()->load('roles'));
    



})->middleware('auth:sanctum');


Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResource('students', StudentController::class);
    Route::apiResource('users', UserController::class);
    Route::apiResource('programs', ProgramController::class);

    Route::get('student/{student}', [StudentController::class, 'show']);
    Route::get('classes', ClassController::class);
    Route::get('sections', SectionController::class);
    Route::post('/loginPentadbir', [PentadbirLoginController::class, 'login']);
    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/units', [UnitController::class, 'index']);
    Route::get('/programs', [ProgramController::class, 'index']);
    Route::get('/programs/{id}', [ProgramController::class, 'show']);
    Route::put('/programs/{id}', [ProgramController::class, 'update']);
    Route::delete('/programs/{id}', [ProgramController::class, 'destroy']);
    Route::post('/programs/{id}/register', [ProgramRegistrationController::class, 'register']);
    Route::get('/peserta/programs', [ProgramController::class, 'indexPesertaPrograms']);//dptkan count peserta program
    Route::get('/programs/{id}/participants', [ProgramController::class, 'getParticipants']);//liskan senarai peserta proram
    Route::post('/attendance/manual', [AttendanceController::class, 'storeManual']);
    Route::get('/user-role-counts', [UserStatsController::class, 'getUserRoleCounts']);// get count user peserta, penganjur, pentadbir
    Route::get('/user-counts', [UserController::class, 'getUserCounts']);
    Route::get('/penganjur/dashboard-counts', [DashboardPenganjurController::class, 'getPenganjurDashboardCounts']);
    Route::get('/dashboard-peserta', [DashboardPesertaController::class, 'getPesertaDashboardData']);
    Route::get('/calendar/events', [CalendarController::class, 'getEvents']);
    Route::get('/attendance/{program_id}', [AttendanceController::class, 'getAttendanceByDate']);
    Route::post('/attendance/manual', [AttendanceController::class, 'storeManualAttendance']);
    Route::post('/attendance/manual/delete', [AttendanceController::class, 'deleteManualAttendance']);
    Route::get('/attendance/{program_id}/list', [AttendanceController::class, 'getAttendanceList']);
    Route::get('/programs/{id}/attendance-summary', [ProgramController::class, 'attendanceSummary']);
    Route::get('/certificate/download/{programId}', [CertificateController::class, 'downloadCertificate']);
    Route::get('/certificate/eligibility/{programId}', [CertificateController::class, 'checkEligibility']);
    Route::put('/programs/{id}/toggle-certificate', [ProgramController::class, 'toggleCertificate']);
    Route::post('/materials', [ProgramMaterialController::class, 'store']);
    Route::get('/materials/{program_id}', [ProgramMaterialController::class, 'index']);
    Route::delete('/materials/{id}', [ProgramMaterialController::class, 'destroy']);

});

