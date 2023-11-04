<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:photos.index|photos.create|photos.edit|photos.delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $photos = Photo::latest()->when(request()->q, function ($photos) {
            $photos = $photos->where('caption', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.photo.index', compact('photos'));
    }

    /**
     * Display the specified resource.
     */
    public function create()
    {
        return view('admin.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpg,jpeg,max:2000',
            'caption' => 'required'
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/photos', $image->hashName());

        $photo = Photo::create([
            'image' => $image->hashName(),
            'caption' => $request->input('caption'),
        ]);

        if ($photo) {
            return redirect()->route('admin.photo.index')->with(['success' => 'Saved data successfully!']);
        } else {
            return redirect()->route('admin.photo.index')->with(['error' => 'Saved data Failed!']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $photo = Photo::findOrFail($id);
        Storage::disk('local')->delete('public/photos/' . basename($photo->image));
        $photo->delete();

        if ($photo) {
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