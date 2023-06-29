<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.products.show', compact('product'));
    }

    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        // Vérifiez si le produit est déjà dans le panier de l'utilisateur
        $cartItem = Cart::where('product_id', $product->id)
                        ->where('user_id', Auth::id())
                        ->first();

        if ($cartItem) {
            // Le produit existe déjà dans le panier, mettez à jour la quantité
            $cartItem->quantity += $request->input('quantity');
            $cartItem->save();
        } else {
            // Le produit n'existe pas dans le panier, créez une nouvelle entrée
            $cartItem = new Cart();
            $cartItem->product_id = $product->id;
            $cartItem->user_id = Auth::id();
            $cartItem->quantity = $request->input('quantity');
            $cartItem->save();
        }

        return redirect()->route('frontend.cart')->with('success', 'Le produit a été ajouté au panier.');
    }

}
