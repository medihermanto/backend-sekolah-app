<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    public function index()
    {
        $teachers = Teacher::latest()->paginate(6);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data teachers"
            ],
            "data" => $teachers
        ], 200);
    }

    public function TeacherHomePage()
    {
        $teachers = Teacher::latest()->take(4)->get();
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data teachers"
            ],
            "data" => $teachers
        ], 200);
    }
}
