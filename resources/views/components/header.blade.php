<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image" href="{{ asset('img/enqueteur caen.png') }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Association Haie-Vigné</title>
    @vite(['resources/js/app.js', 'resources/js/burger.js', 'resources/js/activity.js', 'resources/js/slider.js'])
    @vite('resources/scss/main.scss')

</head>

<body>
    <header class="header-container">
        <div class="header-logo">
            <img src="{{ asset('asset/img/logo.png') }}" alt="logo">
            <img class="logo-txt" src="{{ asset('asset/img/logo-titre.png') }}" alt="logo">
        </div>

        <div class="nav__lg">
            <ul class="nav__lg-lst">
                <li><a class="nav__lnk link" href="{{ url('/') }}">Accueil</a></li>
                <li><a class="nav__lnk link" href="{{ url('price') }}">tarifs</a></li>
                <li><a class="nav__lnk link" href="{{ url('activities') }}">Nos activités</a></li>
                <li><a class="nav__lnk link" href="{{ url('contact') }}">Nous contacter</a></li>
                <li><a class="nav__lnk link" href="{{ url('form') }}">S'inscrire</a></li>
            </ul>
        </div>

        <div class="menu__toggle" id="burger__menu">
            <span class="menu__toggle-bar"></span>
        </div>
        <nav id="menu">
            <ul class="menu__container">
                <li class="menu__container-itm">
                    <a class="menu__container-lnk" href="{{ url('/') }}">Accueil</a>
                </li>
                <li class="menu__container-itm">
                    <a class="menu__container-lnk" href="{{ url('activities') }}">Nos activités</a>
                </li>
                <li class="menu__container-itm">
                    <a class="menu__container-lnk" href="{{ url('price') }}">tarifs</a>
                </li>
                <li class="menu__container-itm">
                    <a class="menu__container-lnk" href="{{ url('form') }}">S'inscrire</a>
                </li>
                <li class="menu__container-itm">
                    <a class="menu__container-lnk" href="{{ url('contact') }}">Nous contacter</a>
                </li>
            </ul>
        </nav>
    </header>
