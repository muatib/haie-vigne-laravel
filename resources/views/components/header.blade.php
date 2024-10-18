<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Association sportive Haie-Vigné</title>
    <meta name="description" content="A caen l'association existe depuis 1991. En 2023, nous avons changé de nom 'Association Sport et Bien-Etre Haie Vigné'. Nous avons rejoint la fédération de l'Ufolep.">


    <link rel="shortcut icon" type="image/ico" href="asset/img/logo-assoc.ico" >
>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.bunny.net">


    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></noscript>

    @yield('scripts')
    @vite('resources/scss/main.scss', 'resources/js/burger.js')

</head>

<body>
    <header class="header-container">
        <div class="header-logo">
            <img class="logo-site" src="{{ asset('asset/img/logo-site.png') }}" alt="logo de l'association">
            {{-- <img class="logo-txt" src="{{ asset('asset/img/logo-titre.png') }}" alt="logo"> --}}
        </div>
        <div class="header-actions">
            <a href="{{ route('UserAccount') }}" class="account-icon">
                <div class="user-status-indicator {{ Auth::check() ? 'logged-in' : 'logged-out' }}">
                    <i class="fas fa-user"></i>
                    <span class="user-status-text">{{ Auth::check() ? Auth::user()->firstname : 'Connexion' }}</span>
                </div>
            </a>
        </div>
        <div class="nav-lg">
            <ul class="nav-lg-lst">
                <li class="admin-link">
                    @if (auth()->check() && auth()->user()->is_admin)
                        <a class="menu-container-lnk nav-lnk link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">Page administration</a>
                    @endif
                </li>
                <li><a class="nav-lnk link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Accueil</a></li>
                <li><a class="nav-lnk link {{ request()->is('price') ? 'active' : '' }}" href="{{ url('price') }}">tarifs</a></li>
                {{-- <li><a class="nav-lnk link {{ request()->is('activityContent') ? 'active' : '' }}" href="{{ url('activityContent') }}">Nos activités</a></li>
                <li><a class="nav-lnk link {{ request()->is('actualityContent') ? 'active' : '' }}" href="{{ url('actualityContent') }}">Notre actualité</a></li> --}}
                <li><a class="nav-lnk link {{ request()->is('contact') ? 'active' : '' }}" href="{{ url('contact') }}">Nous contacter</a></li>
                <li><a class="nav-lnk link {{ request()->is('form') ? 'active' : '' }}" href="{{ url('form') }}">S'inscrire</a></li>
            </ul>
        </div>


            <div class="menu-toggle" id="burger__menu">
                <span class="menu-toggle-bar"></span>
            </div>


            <nav id="menu">
                <ul class="menu-container">
                    @if (auth()->check() && auth()->user()->is_admin)
                        <li><a class="menu-container-lnk link" href="{{ url('dashboard') }}">Page administration</a></li>
                    @endif

                    <li class="menu-container-itm">
                        <li><a class="menu-container-lnk" href="{{ route('home') }}">Accueil</a>
                    </li>

                    <li class="menu-container-itm">
                        <a class="menu-container-lnk" href="{{ url('activityContent') }}">Nos activités</a>
                    </li>
                    <li class="menu-container-itm">
                        <a class="menu-container-lnk" href="{{ url('actualityContent') }}">Notre actualité</a>
                    </li>
                    <li class="menu-container-itm">
                        <a class="menu-container-lnk" href="{{ url('price') }}">Tarifs</a>
                    </li>
                    <li class="menu-container-itm">
                        <a class="menu-container-lnk" href="{{ url('form') }}">S'inscrire</a>
                    </li>
                    <li class="menu-container-itm">
                        <a class="menu-container-lnk" href="{{ url('contact') }}">Nous contacter</a>
                    </li>
                </ul>
            </nav>

    </header>
