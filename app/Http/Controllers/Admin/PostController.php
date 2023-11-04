<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:posts.index|posts.create|posts.edit|posts.delete');
    }

    public function index()
    {
        $posts = Post::latest()->when(request()->q, function ($posts) {
            $posts = $posts->where('title', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.post.index', compact('posts'));
    }

    public function create(Category $category, Tag $tags)
    {
        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();
        return view('admin.post.create', compact('categories', 'tags'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:5000',
            'title' => 'required|unique:posts',
            'category_id' => 'required',
            'content' => 'required',
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        $post = Post::create([
            'image' => $image->hashName(),
            'title' => $request->input('title'),
            'slug' => Str::slug($request->input('title'), '-'),
            'category_id' => $request->input('category_id'),
            'content' => $request->input('content')
        ]);

        // assign tags
        $post->tags()->attach($request->input('tags'));
        $post->save();

        if ($post) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.post.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.post.index')->with(['error' => 'Saved Data Failed!']);
        }
    }

    public function edit(Post $post)
    {

        $categories = Category::latest()->get();
        $tags = Tag::latest()->get();

        return view('admin.post.edit', compact('post', 'categories', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        $this->validate($request, [
            'title' => 'required|unique:posts,title,' . $post->id,
            'category_id' => 'required',
            'content' => 'required',
        ]);

        if ($request->file('image') == "") {
            $post = Post::findOrFail($post->id);
            $post->update([
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content' => $request->input('content')
            ]);
        } else {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:5000'
            ]);

            // remove old image
            Storage::disk('local')->delete('public/posts/' . $post->image);
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post = Post::findOrFail($post->id);
            $post->update([
                'image' => $image->hashName(),
                'title' => $request->input('title'),
                'slug' => Str::slug($request->input('title'), '-'),
                'category_id' => $request->input('category_id'),
                'content' => $request->input('content')
            ]);
        }

        $post->tags()->sync($request->input('tags'));
        if ($post) {
            return redirect()->route('admin.post.index')->with(['success' => 'Update Data Successfully!']);
        } else {
            return redirect()->route('admin.post.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        if ($post) {
            return response()->json([
                'status' => 'success'
            ]);
        } else {
            return response()->json([
                'status' => 'error'
            ]);
        }
    }
}
