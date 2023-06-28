@extends('backend.layout.base')

@section('content')

<div class="product-container">
  
<h1 class="title" colspan="3">Liste des produits</h1>

<a href="{{ route('backend.products.create') }}" class="btn-create">Ajouter un nouveau produit</a>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->title }}</td>
                <td>{{ $product->price }} €</td>
                <td class="action-row">
                    <a href="{{ route('backend.products.edit', $product->id) }}"><i class="fa-solid fa-pen-to-square" style="color: #868fd5;"></i></a>
                    <form action="{{ route('backend.products.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button" style="background: none; border: none; cursor: pointer;">
                            <i class="fa-solid fa-trash" style="color: #ff000d;"></i>
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>


</div>
@endsection
