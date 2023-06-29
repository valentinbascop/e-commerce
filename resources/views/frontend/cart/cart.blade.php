@extends('frontend.layout.base')

@section('content')
<div class="cart-container">
    <div class="cart">
        <h1>Panier</h1>

        @if ($cartItems->isEmpty())
            <p>Le panier est vide.</p>
        @else
            <table class="cart-table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Produit</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $cartItem)
                        <tr>
                            <td>
                                <img src="{{ $cartItem->product->getPicture()->getImageUrl() }}" alt="{{ $cartItem->product->title }}" class="product-image">
                            </td>
                            <td>{{ $cartItem->product->title }}</td>
                            <td>{{ $cartItem->product->price }} €</td>
                            <td>{{ $cartItem->quantity }}</td>
                            <td>{{ $cartItem->product->price * $cartItem->quantity }} €</td>
                            <td>
                                <form action="{{ route('frontend.cart.remove', $cartItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-remove">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Total</td>
                        <td>{{ $total }} €</td>
                    </tr>
                </tfoot>
            </table>
        @endif
    </div>
</div>
@endsection
