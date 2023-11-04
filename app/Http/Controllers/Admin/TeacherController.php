<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TeacherController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:teachers.index|teachers.create|teachers.edit|teachers.delete');
    }

    public function index()
    {
        $teachers = Teacher::latest()->when(request()->q, function ($teachers) {
            $teachers = $teachers->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        $subjects = Subject::latest()->get();
        return view('admin.teacher.create', compact('subjects'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|mimes:png,jpg,jpeg,png|max:2000',
            'name' => 'required',
            'date_of_birth' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:teachers',
            'position' => 'required',
            'subject_id' => 'required',
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/teachers', $image->hashName());

        $teacher = Teacher::create([
            'image' => $image->hashName(),
            'name' => $request->input('name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'position' => $request->input('position'),
            'subject_id' => $request->input('subject_id'),
        ]);

        if ($teacher) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.teacher.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.teacher.index')->with(['error' => 'Saved Data Failed!']);
        }
    }

    public function edit(Teacher $teacher)
    {
        $subjects = Subject::latest()->get();

        return view('admin.teacher.edit', compact('subjects', 'teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $this->validate($request, [
            'name' => 'required',
            'date_of_birth' => 'required',
            'phone' => 'required',
            'email' => 'required|unique:teachers,email,' . $teacher->id,
            'position' => 'required',
            'subject_id' => 'required',
        ]);

        $teacher = Teacher::findOrFail($teacher->id);

        if ($request->file('image') == "") {
            $teacher->update([
                'name' => $request->input('name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'position' => $request->input('position'),
                'subject_id' => $request->input('subject_id'),
            ]);
        } else {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2000'
            ]);

            // remove old image
            Storage::disk('local')->delete('public/teachers/' . $teacher->image);
            $image = $request->file('image');
            $image->storeAs('public/teachers', $image->hashName());

            $teacher->update([
                'image' => $image->hashName(),
                'name' => $request->input('name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'position' => $request->input('position'),
                'subject_id' => $request->input('subject_id'),
            ]);
        }
        if ($teacher) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.teacher.index')->with(['success' => 'Update Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.teacher.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);
        $teacher->delete();

        if ($teacher) {
            return response()->json([
                'status' => 'success',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
            ]);
        }
    }
}
