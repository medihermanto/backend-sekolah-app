<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:subjects.index|subjects.create|subjects.edit|subjects.delete');
    }

    public function index()
    {
        $subjects = Subject::latest()->when(request()->q, function ($subjects) {
            $subjects = $subjects->where('subject', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.subject.index', compact('subjects'));
    }
    public function create()
    {
        return view('admin.subject.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'subject' => 'required|unique:subjects',
            'description' => 'required'
        ]);

        $subject = Subject::create([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
        ]);

        if ($subject) {
            return redirect()->route('admin.subject.index')->with(['success' => 'Saved data successfully!']);
        } else {
            return redirect()->route('admin.subject.index')->with(['error' => 'Saved data Failed!']);
        }
    }

    public function edit(Subject $subject)
    {
        return view('admin.subject.edit', compact('subject'));
    }

    public function update(Request $request, Subject $subject)
    {
        $this->validate($request, [
            'subject' => 'required|unique:subjects,subject,' . $subject->id,
            'description' => 'required',
        ]);

        $subject = Subject::findOrFail($subject->id);

        $subject->update([
            'subject' => $request->input('subject'),
            'description' => $request->input('description'),
        ]);

        if ($subject) {
            return redirect()->route('admin.subject.index')->with(['success' => 'Update data successfully!']);
        } else {
            return redirect()->route('admin.subject.index')->with(['error' => 'Update data Failed!']);
        }
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();

        if ($subject) {
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