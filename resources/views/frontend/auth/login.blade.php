@extends('frontend.layout.base')

@section('title', "Connexion")

@section('content')

<div class="register-container">

    <h1 class="title">Connexion</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li class="error-message">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('frontend.login') }}" class="form-container">
        @csrf

        <div class="form-row">
            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-row">
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="submit-btn">
            <button type="submit">Se connecter</button>
        </div>
    </form>

</div>

@endsection