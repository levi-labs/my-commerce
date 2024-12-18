<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductService
{

    public function hanldeProductImageUpload(&$data)
    {
        if (array_key_exists('image_url', $data)) {
            $file = $data['image_url']->store('images', 'public');
            $data['image_url'] = $file;
        }
    }
    public function getAllProducts($perpage = 10)
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.name', 'products.image_url',  'products.description', 'products.price', 'categories.name as category_name')
            ->paginate($perpage);
        return $products;
    }

    public function searchProduct($query, $perpage = 10)
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.id', 'products.name', 'products.image_url', 'products.description', 'products.price', 'categories.name as category_name')
            ->where('products.name', 'like', '%' . $query . '%')
            ->orWhere('categories.name', 'like', '%' . $query . '%')
            ->paginate($perpage);
        return $products;
    }

    public function getProductById($id)
    {
        return Product::findOrFail($id);
    }

    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function updateProduct($id, $data)
    {
        $product = Product::findOrFail($id);
        if (isset($data['image_url'])) {
            if ($product->image_url !== null) {
                handle_delete_file($product->image_url);
            }
        }

        $product->update($data);
        return $product;
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if ($product->image_url !== null) {
            handle_delete_file($product->image_url);
        }

        $product->delete();
        return $product;
    }
}
