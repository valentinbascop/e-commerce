@extends('frontend.layout.base')

@section('title', "Page d'accueil")

@section('content')

<div class="home-container">

    <h1 class="title">Bienvenue sur notre site de e-commerce</h1>

    <h2>Ces produits peuvent vous intéresser :</h2>
    <div class="slider-container">
        @foreach ($products as $product)
            <div class="product-item">
                <div class="product-item-img">
                    <img src="{{ $product->getPicture()->getImageUrl() }}" alt="Product Image">
                </div>
                <h3>{{ $product->title }}</h3>
                <p>Prix : {{ $product->price }} €</p>
                <a href="{{ route('frontend.products.show', $product->id) }}" class="btn-see-product">Voir le produit</a>
            </div>
        @endforeach
    </div>

</div>

@endsection
