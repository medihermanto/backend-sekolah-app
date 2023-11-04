<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->paginate(1);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data profile"
            ],
            "data" => $profiles
        ], 200);
    }

    public function ProfileHomePage()
    {
        $profiles = Profile::latest()->take(1)->get();
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data profile homepage"
            ],
            "data" => $profiles
        ], 200);
    }
}
