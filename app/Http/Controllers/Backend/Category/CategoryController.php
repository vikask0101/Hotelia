<?php

namespace App\Http\Controllers\Backend\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Category\StoreCategoryRequest;
use App\Http\Requests\Backend\Category\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.categories.index', [
            'categories' => Category::all()
        ]);
    }

    public function create()
    {
        return view('backend.categories.create');
    }

    public function store(StoreCategoryRequest $request)
    {
        try {
            Category::createCategory($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Category created successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function edit(Category $category)
    {
        return view('backend.categories.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->updateCategory($request->validated());
            return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }

    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }

    public function updateStatus(Request $request, Category $category)
    {
        $category->updateStatus($request->input('status'));

        return redirect()->route('admin.categories.index')->with('success', 'Category status updated successfully!');
    }
}
