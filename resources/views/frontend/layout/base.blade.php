<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="{{ asset('css/style.css') }}" >

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.css" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick-theme.min.css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.6.0/slick.min.js"></script>
  <title>@yield('title')</title>
</head>
<body>

<nav class="navbar">
  <div class="nav-container">
    <a class="navbar-home" href="/">Home</a>
  </div>
  <div class="nav-item-container">
    <ul>
      @guest
      <li>
          <a href="{{ route('frontend.register') }}">S'inscrire</a>
        </li>
        <li>
          <a href="{{ route('frontend.login') }}">Connexion</a>
        </li>
      @else
        <li>
          <a href="{{ route('frontend.seeInfo') }}">Profil</a>
        </li>
        <li>
          <form method="POST" action="{{ url('/logout') }}" class="log-out-btn">
            @csrf
            <button type="submit">Déconnexion</button>
          </form>
        </li>
      @endguest
    </ul>
  </div>
</nav>

<div class="container">
    @yield('content')
</div>

<script src="{{ asset('js/script.js') }}?v=1.5"></script>
</body>
</html>
