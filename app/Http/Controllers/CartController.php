<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;
        
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        
        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Request $request)
    {
        $cart = session()->get('cart', []);
        
        $itemId = uniqid();
        
        $cart[$itemId] = [
            'id' => $itemId,
            'product_id' => $request->product_id,
            'product_name' => $request->product_name,
            'price' => $request->price,
            'quantity' => $request->quantity ?? 1,
            'is_custom' => $request->is_custom ?? false,
            'custom_notes' => $request->custom_notes ?? null,
            'bottle_size_id' => $request->bottle_size_id ?? null,
        ];
        
        session()->put('cart', $cart);
        
        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
            
            return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
        }
        
        return redirect()->route('cart.index')->with('error', 'Item not found in cart!');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            
            return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
        }
        
        return redirect()->route('cart.index')->with('error', 'Item not found in cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
