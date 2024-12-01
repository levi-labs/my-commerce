<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $title = 'Product Page';

        $products = $this->productService->getAllProducts();

        return view('pages.product.index', compact('title', 'products'));
    }

    public function show(Product $product)
    {
        $product = $this->productService->getProductById($product->id);
        return view('pages.product.show', compact('product'));
    }
    public function create()
    {
        $title = 'Create Product';
        $categories = Category::all();
        return view('pages.product.create', compact('title', 'categories'));
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /******  8e36e27e-34bc-46e7-a25e-1effaf76a5f4  *******/
    public function store(ProductRequest $request)
    {
        $this->productService->createProduct($request->all());
        return redirect()->route('product.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $title = 'Edit Product';
        $product = $this->productService->getProductById($product->id);
        return view('pages.product.edit', compact('title', 'product'));
    }

    public function update(Product $product, ProductRequest $request)
    {
        $this->productService->updateProduct($product->id, $request->all());
        return redirect()->route('product.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product->id);
        return redirect()->route('product.index')->with('success', 'Product deleted successfully');
    }
}
