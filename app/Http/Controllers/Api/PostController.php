<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->paginate(9);
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "list data post",
            ],
            "data" => $posts
        ], 200);
    }

    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();

        if ($post) {
            return response()->json([
                "response" => [
                    "status" => 200,
                    "message" => "Detail data post",
                ],
                "data" => $post
            ], 200);
        } else {
            return response()->json([
                "response" => [
                    "status" => 404,
                    "message" => "Data Post Not Found!"
                ],
                "data" => null
            ], 404);
        }
    }

    public function PostHomePage()
    {
        $posts = Post::latest()->take(4)->get();
        return response()->json([
            "response" => [
                "status" => 200,
                "message" => "List Data Post Homepage"
            ],
            "data" => $posts
        ], 200);
    }
}
