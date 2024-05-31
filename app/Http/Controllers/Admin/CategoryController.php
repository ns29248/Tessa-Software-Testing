<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllCategories();
        return view('admin.category')->with('categories', $categories);
    }

    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->createCategory($request->validated());
        return redirect()->route('categories.edit', $category)->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.edit-category', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, $request->validated());
        return redirect()->route('categories.edit', $category)->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
    }
}

