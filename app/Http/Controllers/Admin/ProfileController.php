<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profiles.index|profiles.edit|profiles.create|profiles.delete');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profiles = Profile::latest()->when(request()->q, function ($profiles) {
            $profiles = $profiles->where('visi', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.profile.index', compact('profiles'));
    }

    public function create()
    {
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'opening_speech' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:5000',
            'visi' => 'required',
            'misi' => 'required',
            'profile' => 'required',
            'struktur_organisasi' => 'required',
            'informasi_pendaftaran' => 'required',
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/profiles', $image->hashName());

        $profile = Profile::create([
            'opening_speech' => $request->input('opening_speech'),
            'image' => $image->hashName(),
            'visi' => $request->input('visi'),
            'misi' => $request->input('misi'),
            'profile' => $request->input('profile'),
            'struktur_organisasi' => $request->input('struktur_organisasi'),
            'informasi_pendaftaran' => $request->input('informasi_pendaftaran'),
        ]);

        if ($profile) {
            return redirect()->route('admin.profile.index')->with(['success' => 'Saved Data Succesfully!']);
        } else {
            return redirect()->route('admin.profile.index')->with(['error' => 'Saved Data Failed!']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function edit(Profile $profile)
    {
        $profiles = Profile::findOrFail($profile->id);
        return view('admin.profile.edit', compact('profiles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profile $profile)
    {
        $this->validate($request, [
            'opening_speech' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'profile' => 'required',
            'struktur_organisasi' => 'required',
            'informasi_pendaftaran' => 'required',
        ]);

        $image = $request->file('image');
        $profile = Profile::findOrFail($profile->id);
        if ($image) {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:5000'
            ]);
            // remove old image
            Storage::disk('local')->delete('public/profiles/' . $profile->image);
            $image->storeAs('public/posts', $image->hashName());
            $profile->update([
                'opening_speech' => $request->input('opening_speech'),
                'image' => $image->hashName(),
                'visi' => $request->input('visi'),
                'misi' => $request->input('misi'),
                'profile' => $request->input('profile'),
                'struktur_organisasi' => $request->input('struktur_organisasi'),
                'informasi_pendaftaran' => $request->input('informasi_pendaftaran'),
            ]);
        } else {
            $profile->update([
                'opening_speech' => $request->input('opening_speech'),
                'visi' => $request->input('visi'),
                'misi' => $request->input('misi'),
                'profile' => $request->input('profile'),
                'struktur_organisasi' => $request->input('struktur_organisasi'),
                'informasi_pendaftaran' => $request->input('informasi_pendaftaran'),
            ]);
        }

        if ($profile) {
            return redirect()->route('admin.profile.index')->with(['success' => 'Update Data Succesfully!']);
        } else {
            return redirect()->route('admin.profile.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $profile = Profile::findOrFail($id);
        $profile->delete();

        if ($profile) {
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
