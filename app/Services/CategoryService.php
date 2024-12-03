<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{

    public function getAllCategories($perpage = null)
    {
        if ($perpage === null) {
            $categories = Category::all();
        } else {
            $categories = DB::table('categories')
                ->leftJoin('products', 'categories.id', '=', 'products.category_id')
                ->select('categories.id', 'categories.name', 'categories.description', DB::raw('count(products.id) as product_count'))
                ->groupBy('categories.id', 'categories.name', 'categories.description')
                ->paginate($perpage);
        }

        return $categories;
    }

    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }

    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function updateCategory($id, $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return $category;
    }
}
