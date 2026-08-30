
<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::latest()->get();

        return response()->json([
            'message' => 'Students retrieved successfully',
            'data' => $students,
        ]);
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|unique:students,email',
            'phone'       => 'nullable|string|max:20',
            'class_name'  => 'required|string|max:100',
            'roll_number' => 'nullable|string|max:100',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'message' => 'Student created successfully',
            'data'    => $student,
        ], 201);
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        return response()->json([
            'message' => 'Student retrieved successfully',
            'data'    => $student,
        ]);
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'nullable|email|unique:students,email,' . $student->id,
            'phone'       => 'nullable|string|max:20',
            'class_name'  => 'required|string|max:100',
            'roll_number' => 'nullable|string|max:100',
        ]);

        $student->update($validated);

        return response()->json([
            'message' => 'Student updated successfully',
            'data'    => $student->fresh(),
        ]);
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student deleted successfully',
        ]);
    }
}

