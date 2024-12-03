<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }



    public function index()
    {
        $title = 'Category Page';

        $categories = $this->categoryService->getAllCategories(10);

        return view('pages.category.index', compact('title', 'categories'));
    }

    public function create()
    {
        $title = 'Create Category';

        return view('pages.category.create', compact('title'));
    }

    public function store(CategoryRequest $request)
    {
        $this->categoryService->createCategory($request->all());
        return redirect()->route('category.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        $title = 'Edit Category';

        return view('pages.category.edit', compact('title', 'category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category->id, $request->all());
        return redirect()->route('category.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category->id);
        return redirect()->route('category.index')->with('success', 'Category deleted successfully');
    }
}
