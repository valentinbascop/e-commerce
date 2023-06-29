<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, Product $product)
    {
        $user = Auth::user();
        $cartItem = Cart::where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {
            // Si le produit est déjà dans le panier, augmentez simplement la quantité
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // Sinon, créez un nouvel élément dans le panier
            $cartItem = new Cart();
            $cartItem->user_id = $user->id;
            $cartItem->product_id = $product->id;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        return redirect()->route('frontend.cart')->with('success', 'Produit ajouté au panier avec succès.');
    }

    public function showCart()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->get();
        $total = 0;

        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
        }

        return view('frontend.cart.cart', compact('cartItems', 'total'));
    }

    public function removeFromCart(Cart $cartItem)
{
    $cartItem->delete();

    return redirect()->route('frontend.cart')->with('success', 'Produit supprimé du panier avec succès.');
}

}
