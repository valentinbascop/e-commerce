@extends('frontend.layout.base')

@section('title', 'Modifier le profil')

@section('content')

<div class="profile-container">

    <h1 class="title">Modifier le profil</h1>

    <form method="POST" action="{{ route('frontend.profile.update') }}" class="profile-form">
        @csrf
        @method('PUT')
        <div class="form-group form-row">
            <label for="firstname">Prénom</label>
            <input type="text" id="firstname" name="firstname" value="{{ $user->firstname }}" required>
            @error('firstname')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group form-row">
            <label for="lastname">Nom</label>
            <input type="text" id="lastname" name="name" value="{{ $user->name }}" required>
            @error('lastname')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group form-row">
            <label for="email">Adresse e-mail</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group form-row">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" minlength="6">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group form-row">
            <label for="password_confirmation">Confirmation du mot de passe</label>
            <input type="password" id="password_confirmation" name="password_confirmation">
        </div>
        <div class="form-group form-row submit-btn">
            <button type="submit">Enregistrer</button>
            <a href="{{ route('frontend.seeInfo') }}">Retour</a>
        </div>
    </form>

</div>

@endsection
