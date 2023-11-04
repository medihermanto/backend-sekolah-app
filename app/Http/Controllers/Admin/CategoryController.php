<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:categories.index|categories.create|categories.edit|categories.delete');
    }

    public function index()
    {
        $categories = Category::latest()->when(request()->q, function ($categories) {
            $categories = $categories->where('name', 'like', '%' . request()->q . '%');
        })->paginate(10);

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories'
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-')
        ]);

        if ($category) {
            return redirect()->route('admin.category.index')->with(['success' => 'Saved Data Successfully!']);
        } else {
            return redirect()->route('admin.category.index')->with(['error' => 'Saved Data Faiedl!']);
        }
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $this->validate($request, [
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category = Category::findOrFail($category->id);
        $category->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name'), '-')
        ]);

        if ($category) {
            return redirect()->route('admin.category.index')->with(['success' => 'Updated Data Successfully!']);
        } else {
            return redirect()->route('admin.category.index')->with(['error' => 'Updated Data Faiedl!']);
        }
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category) {
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
