<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:sliders.index|sliders.create|sliders.edit|sliders.delete');
    }

    public function index()
    {
        $sliders = Slider::latest()->when(request()->q, function ($sliders) {
            $sliders = $sliders->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.slider.index', compact('sliders'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image'     => 'required|image',
        ]);

        //upload image
        $image = $request->file('image');
        $image->storeAs('public/sliders', $image->hashName());

        $slider = Slider::create([
            'image'     => $image->hashName(),
        ]);

        if ($slider) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.slider.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.slider.index')->with(['error' => 'Saved Data Succesfully!']);
        }
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $image = Storage::disk('local')->delete('public/sliders/' . basename($slider->image));
        $slider->delete();

        if ($slider) {
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
