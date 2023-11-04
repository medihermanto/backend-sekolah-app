<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::latest()->paginate(6);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data students"
            ],
            "data" => $students
        ], 200);
    }

    public function StudentHomePage()
    {
        $students = Student::all();
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data students homepage"
            ],
            "data" => $students
        ], 200);
    }
}
