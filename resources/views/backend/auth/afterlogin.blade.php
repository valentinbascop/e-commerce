@extends('frontend.layout.base')

@section('title', "Informations profil")

@section('content')

<div class="profile-container">

    <div class="profile-info-container">
        <h1 class="title">Bienvenue, {{ $user->firstname }} {{ $user->name }}!</h1>
        <div class="profile-info">
            <p>Félicitations, vous êtes maintenant connecté.</p>
            <p>Votre prénom : {{ $user->firstname }}</p>
            <p>Votre nom : {{ $user->name }}</p>
            <p>Votre adresse email : {{ $user->email }}</p>
        </div>

        <form method="POST" action="{{ url('/logout') }}" class="submit-btn">
            @csrf
            <button type="submit">Déconnexion</button>
        </form>
    
    </div>

</div>

@endsection