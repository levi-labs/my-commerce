<?php

namespace App\Http\Controllers;

use App\Http\Requests\CartRequest;
use App\Models\Cart;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cartService;
    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }
    public function store(CartRequest $request)
    {
        $data = $request->all();
        $user = auth('web')->user()->id;

        $this->cartService->addToCart($data['product_id'], $user);

        return redirect()->back()->with('success', 'Product added to cart successfully');
    }

    public function update(CartRequest $request)
    {
        $data = $request->all();
        $this->cartService->updateCart($data);
        return redirect()->back()->with('success', 'Product quantity updated successfully');
    }
}
