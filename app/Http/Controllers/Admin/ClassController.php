<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:classes.index|classes.create|classes.edit|classes.delete');
    }

    public function index()
    {
        $classes = Classes::latest()->when(request()->q, function ($classes) {
            $classes = $classes->where('name', 'like', '%' . request()->q . '%');
        })->paginate(5);
        return view('admin.class.index', compact('classes'));
    }

    public function create()
    {
        $teachers = Teacher::latest()->get();
        return view('admin.class.create', compact('teachers'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'teacher_id' => 'required'
        ]);

        $class = Classes::create([
            'name' => $request->input('name'),
            'teacher_id' => $request->input('teacher_id'),
        ]);

        if ($class) {
            return redirect()->route('admin.class.index')->with(['success' => 'Save data successfully!']);
        } else {
            return redirect()->route('admin.class.index')->with(['error' => 'Save data failed!']);
        }
    }

    public function edit(Classes $class)
    {
        $classes = Classes::findOrFail($class->id);
        $teachers = Teacher::latest()->get();
        return view('admin.class.edit', compact('classes', 'teachers'));
    }

    public function update(Request $request, Classes $class)
    {
        $this->validate($request, [
            'name' => 'required',
            'teacher_id' => 'required',
        ]);
        $class = Classes::findOrFail($class->id);

        $class->update([
            'name' => $request->input('name'),
            'teacher_id' => $request->input('teacher_id'),
        ]);

        if ($class) {
            return redirect()->route('admin.class.index')->with(['success' => 'Update data successfully!']);
        } else {
            return redirect()->route('admin.class.index')->with(['error' => 'Update data failed!']);
        }
    }

    public function destroy($id)
    {
        $class = Classes::findOrFail($id);
        $class->delete();

        if ($class) {
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
