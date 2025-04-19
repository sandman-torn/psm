<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Http\Resources\StudentResource;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;


class StudentController extends Controller
{
    public function index(Request $request)
    {
        $studentsQuery = Student::query()
            ->search($request);



        return StudentResource::collection(
            $studentsQuery->paginate(10)
        );
    }

    public function store(StoreStudentRequest $request)
    {
        $student = Student::create($request->validated());

        //return StudentResource::make($student);
        return response()->json([
            "message" => "Student created successfully",
        ], 201);
    }

    public function show(Student $student)
    {
        return StudentResource::make($student);
    }

    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student = $student->update($request->validated());

        //return StudentResource::make($student);
        return response()->json([
            "message" => "Student updated successfully",
        ], 201);
    }

    public function destroy(Student $student)
    {
        $student->delete();
        return response()->json([
            "message" => "Student deleted successfully",
        ], 200);
    }

}
