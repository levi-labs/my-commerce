<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartService
{
    public function userCart()
    {
        if (!Auth::check()) {
            return ResponseHelper::unauthorized('Please login first');
        }
        return true;
    }

    public function addToCart($product_id, $user_id)
    {

        $this->userCart();

        $cart = Cart::updateOrCreate(
            ['user_id' => $user_id, 'product_id' => $product_id],
            ['quantity' => DB::raw('quantity +', 1)]
        );
        return $cart;
    }

    public function updateCart($data)
    {
        $this->userCart();

        $cart = Cart::find($data['id']);
        $product_id = Product::where('id', $data['product_id'])->first();
        $temp_quantity = $data['quantity'] + $cart->quantity;
        $cart->quantity =  $temp_quantity;

        return $cart;
    }
}
