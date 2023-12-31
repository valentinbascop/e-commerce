@extends('frontend.layout.base')

@section('title', "Ajout ou modification de produit")

@section('content')

<div class="product-container">
<h1>@if(isset($product)) Modifier le produit @else Créer un nouveau produit @endif</h1>

@if (!$errors->isEmpty())
        @foreach($errors->all() as $error)
      <div class="form-alert form-alert--error">{{ $error }}</div>
        @endforeach
      @endif

<form action="{{ isset($product) ? route('backend.products.update', $product->id) : route('products.store') }}" method="POST" class="form-create-update" enctype="multipart/form-data">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif
    <div class="form-row-row">
        <div class="form-row">
            <label for="title">Nom:</label>
            <input type="text" name="title" id="title" value="{{ old('title', $product->title ?? '') }}" required>
        </div>
    
        <div class="form-row">
            <label for="price">Prix:</label>
            <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required>
        </div>
    </div>
    <div class="form-row-100">
        <div class="form-row">
            <label for="description">Description:</label>
            <textarea name="description" id="description" rows="4" required>{{ old('description', $product->description ?? '') }}</textarea>
        </div>
    </div>
    <div class="form-row-100 form-input">
            <label for="image">Image:</label>
            <input type="file" name="images[]" data-role="file" multiple>
    </div>

        <button type="submit">
            @if(isset($product))
                Mettre à jour
            @else
                Créer
            @endif
        </button>
    </form>

    <a href="{{ route('backend.products.index') }}">Retour à la liste des produits</a>
</div>

@endsection
