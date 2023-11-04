<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::latest()->paginate(6);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data subjects" 
            ],
            "data" => $subjects
        ], 200);
    }

    public function SubjectHomePage()
    {
        $subjects = Subject::all();
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data subjects homepage"
            ],
            "data" => $subjects
        ], 200);
    }
}