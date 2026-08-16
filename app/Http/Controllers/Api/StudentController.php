<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $students = Student::latest()->get();

        return response()->json([
        'message' => 'Students retrieved successfully',
        'students' => $students,
        ]);
    }
}
