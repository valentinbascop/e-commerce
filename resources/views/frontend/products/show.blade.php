@extends('frontend.layout.base')

@section('title', 'Détails du produit')

@section('content')
    <div class="product-details-container">
        <h1>{{ $product->title }}</h1>
        <div class="product-details">
            <div class="product-details-left">
                <div class="product-details-img">
                    <img src="{{ $product->getPicture()->getImageUrl() }}" alt="Product Image">
                </div>
            </div>
            <div class="product-details-right">
                <p class="price">Prix : {{ $product->price }} €</p>
                <p class="description">{{ $product->description }}</p>
                <button class="add-to-cart">Ajouter au panier</button>
            </div>

        </div>
    </div>
@endsection
