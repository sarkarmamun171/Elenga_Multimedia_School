<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
     public function index()
        {
            $students = Student::latest()->get();

            return response()->json([
                'message' => 'Students retrieved successfully',
                'data' => $students,
            ]);
        }

     public function store(Request $request)
        {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|email|unique:students,email',
                'phone' => 'nullable|string|max:20',
                'class_name' => 'required|string|max:100',
                'roll_number' => 'nullable|string|max:100',
            ]);

            $student = Student::create($validated);

            return response()->json([
                'message' => 'Student created successfully',
                'data' => $student,
            ], 201);
        }

        public function update(Request $request, $id)
            {
                $student = Student::findOrFail($id);

                $validated = $request->validate([
                    'name' => 'required|string|max:255',
                    'email' => 'nullable|email|unique:students,email,' . $student->id,
                    'phone' => 'nullable|string|max:20',
                    'class_name' => 'required|string|max:100',
                    'roll_number' => 'nullable|string|max:100',
                ]);

                $student->update($validated);

                return response()->json([
                    'message' => 'Student updated successfully',
                    'data' => $student,
                ]);
            }
            public function destroy($id)
            {
                $student = Student::findOrFail($id);

                $student->delete();

                return response()->json([
                    'message' => 'Student deleted successfully',
                ]);
            }
}
