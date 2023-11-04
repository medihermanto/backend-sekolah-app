<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Exports\StudentsExport;
use App\Imports\StudentsImport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Closure;
use PDF;

class StudentController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:students.index|students.create|students.edit|students.delete');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::latest()->when(request()->q, function ($students) {
            $students = $students->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);
        return view('admin.student.index', compact('students'));
    }

    public function export()
    {
        $time_download = Carbon::now();
        $time_download->toDateTimeString();
        return Excel::download(new StudentsExport, $time_download . 'students.xlsx');
    }

    public function exportPDF()
    {
        $students = Student::all();
        $data = [
            'title' => 'Rekapitulasi Data Siswa',
            'date' => date('m/d/Y'),
            'students' => $students,
        ];
        $pdf = PDF::loadView('admin.student.importpdf', $data);
        $time_download = Carbon::now();
        $time_download->toDateTimeString();
        return $pdf->download($time_download . ' students.pdf');
    }

    public function import()
    {
        $import =  Excel::import(new StudentsImport, request()->file('file'));

        if ($import) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.student.index')->with(['success' => 'Import Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.student.index')->with(['error' => 'Import Data Failed!']);
        }
    }

    public function create()
    {
        $classes = Classes::latest()->get();
        return view('admin.student.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg|max:2000',
            'name' => 'required',
            'date_of_birth' => 'required',
            'classes_id' => 'required',
            'email' => 'required|unique:students',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // upload image
        $image = $request->file('image');
        $image->storeAs('public/students', $image->hashName());

        $student = Student::create([
            'image' => $image->hashName(),
            'name' => $request->input('name'),
            'date_of_birth' => $request->input('date_of_birth'),
            'classes_id' => $request->input('classes_id'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
        ]);

        if ($student) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.student.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.student.index')->with(['error' => 'Saved Data Failed!']);
        }
    }

    public function edit(Student $student)
    {
        $classes = Classes::latest()->get();
        return view('admin.student.edit', compact('student', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $this->validate($request, [
            'name' => 'required',
            'date_of_birth' => 'required',
            'classes_id' => 'required',
            'email' => 'required|unique:students,email,' . $student->id,
            'phone' => 'required',
            'address' => 'required',
        ]);
        $student = Student::findOrFail($student->id);
        $image = $request->file('image');

        if ($image == "") {
            $student->update([
                'name' => $request->input('name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'classes_id' => $request->input('classes_id'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);
        } else {
            $this->validate($request, [
                'image' => 'required|image|mimes:jpg,png,jpeg|max:2000'
            ]);

            // remove old image
            Storage::disk('local')->delete('public/students/' . $student->image);
            $image->storeAs('public/students', $image->hashName());
            $student->update([
                'image' => $image->hashName(),
                'name' => $request->input('name'),
                'date_of_birth' => $request->input('date_of_birth'),
                'classes_id' => $request->input('classes_id'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
            ]);
        }
        if ($student) {
            //redirect dengan pesan sukses
            return redirect()->route('admin.student.index')->with(['success' => 'Update Data Successfully!']);
        } else {
            //redirect dengan pesan error
            return redirect()->route('admin.student.index')->with(['error' => 'Update Data Failed!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        if ($student) {
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
