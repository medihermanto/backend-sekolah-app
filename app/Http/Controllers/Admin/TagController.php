<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function __construct()
    {
        $this->middleware(['permission:tags.index|tags.create|tags.edit|tags.delete']);
    }

    public function index()
    {
        $tags = Tag::latest()->when(request()->q, function ($tags) {
            $tags = $tags->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.tag.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tag.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags'
        ]);

        $tag = Tag::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-'),
        ]);

        if ($tag) {
            return redirect()->route('admin.tag.index')->with(['success' => 'Saved data successfully!']);
        } else {
            return redirect()->route('admin.tag.index')->with(['error' => 'Saved data failed!']);
        }
    }

    public function edit(Tag $tag)
    {
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->validate($request, [
            'name' => 'required|unique:tags,name,' . $tag->id
        ]);

        $tag = Tag::findOrFail($tag->id);
        $tag->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-')
        ]);
        if ($tag) {
            return redirect()->route('admin.tag.index')->with(['success' => 'Updated data successfully!']);
        } else {
            return redirect()->route('admin.tag.index')->with(['error' => 'Updated data failed!']);
        }
    }

    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        if ($tag) {
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
