@extends('frontend.layout.base')

@section('title', "Inscription")

@section('content')

<div class="register-container">

    <h1 class="title">Inscription</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('backend.register') }}" class="form-container">
        @csrf

        <div class="form-row">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-row">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-row">
            <label for="password_confirmation">Confirmation du mot de passe :</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="submit-btn">
            <button type="submit">S'inscrire</button>
        </div>
    </form>

</div>

@endsection