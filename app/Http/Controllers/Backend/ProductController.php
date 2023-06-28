<?php

namespace App\Http\Controllers\Backend;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('backend.products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
    
        $rules = [
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'images' => 'required|array|min:1',
        ];
    
        if (isset($data['images'])) {
            foreach ($data['images'] as $key => $image) {
                $rules['images.' . $key] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        }
    
        Validator::make($data, $rules)->validate();
    
        $product = Product::create([
            'title' => $data['title'],
            'price' => $data['price'],
            'description' => $data['description'],
        ]);
    
        if (isset($data['images'])) {
            $product->attachFiles($data['images']);
        }
    
        return redirect()->route('products.index');
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.products.create', ['product' => $product]);
    } 

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $data = $request->all();

        //Rules puisque plusieurs images = array, pas besoin de vérifier le format

        $rules = [
            'title' => 'required',
            'price' => 'required',
            'description' => 'required',
            'images' => 'required|array|min:1',
        ];

        //Pour vérifier le format en cas de besoin

        if(isset($data['images'])) {
            foreach($data['images'] as $key => $image) {
                $rules['images.' . $key] = 'image|mimes:jpeg,png,jpg,gif,webp|max:2048';
            }
        }

        Validator::make($data, $rules)->validate();
    
        $product->attachFiles($data['images']);
    
        $product->update($data);
    
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
    
        return redirect()->route('products.index')->with('success', 'Produit supprimé avec succès');
    }
}
