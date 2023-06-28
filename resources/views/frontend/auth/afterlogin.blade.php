@extends('frontend.layout.base')

@section('title', "Options")

@section('content')

<div class="profile-container">

    <h1 class="title">Bienvenue, {{ $user->firstname }} !</h1>

    <div class="options-container">
        <div class="options-row">
        <div class="option-card">
                <h2>Profil</h2>
                <p>Gérez votre profil utilisateur</p>
                <div class="option-card-link">
                    <a href="{{ route('frontend.profile.edit') }}">Accéder</a> <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
            <div class="option-card">
                <h2>Mes commandes</h2>
                <p>Consultez vos commandes passées</p>
                <div class="option-card-link">
                    <a href="">Accéder</a> <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        </div>
        <div class="options-row">
            <div class="option-card">
                <h2>Moyens de paiement</h2>
                <p>Gérez vos moyens de paiement</p>
                <div class="option-card-link">
                    <a href="">Accéder</a> <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
            <div class="option-card">
                <h2>Options</h2>
                <p>Personnalisez vos préférences</p>
                <div class="option-card-link">
                    <a href="">Accéder</a> <i class="fa-solid fa-arrow-right-long"></i>
                </div>
            </div>
        </div>
    </div>

    <form method="POST" action="{{ url('/logout') }}" class="submit-btn">
        @csrf
        <button type="submit">Déconnexion</button>
    </form>

</div>

@endsection
