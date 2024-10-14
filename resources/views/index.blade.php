@include('components.header')

<img class="img-up" src="{{ asset('asset/img/strechead.png') }}" alt="Logo" aria-hidden="true">

@php
    $isAuthenticated = auth()->check();
    $user = auth()->user();
    $isAdmin = $user ? $user->is_admin : false;
@endphp

<h1 class="main-ttl" aria-label="Présentation de l'association">L'association en quelques mots</h1>

<div class="main-txt-container" role="main">
    <p class="main-txt-itm" aria-label="Historique de la Fédération">
        L'association existe depuis 1991.

        En 2023, nous avons changé de nom 'Association Sport et Bien-Etre Haie Vigné'.

        Nous avons rejoint <a href="https://www.ufolep.org/?titre=valeurs&mode=ufolep-en-bref&id=98682.">la fédération
            de l'Ufolep.</a>
    </p>

    <p class="main-txt-itm" aria-label="Création du club">
        Les ambitions sont identiques, prendre soin de soi dans une association proche de chez soi ou de son
        environnement proche ou de son travail.
    </p>

    <p class="main-txt-itm" aria-label="Qualification des animateurs">
        La mairie de Caen en partenaire de soutien.

    <p class="main-txt-itm">Les membres du bureau, bénévoles vous accompagnent tout au long de l'année pour commencer ou
        continuer à bouger.</p>
    <p class="main-txt-itm">Les adhérents habitués sont source de motivation. </p>

    <p class="main-txt-itm">Tous nos animateurs sont des professionnels du sport.</p>T
    </p>

    <p class="main-txt-itm" aria-label="Buts et objectifs">
        Buts et objectifs de l’association :
    </p>

    <ul class="main-txt-itm" aria-label="Liste des objectifs de l'association">
        <li>- Proposer un large choix de séances en termes d’activités et d’horaires</li>
        <li>- Lutter contre la sédentarité</li>
        <li>- Favoriser le lien social en associant loisir et bien-être afin de conserver vitalité et élan pour la vie
            dans une société où forme, bien-être, longévité, convivialité et plaisir sont très recherchés.</li>
    </ul>
</div>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">

@include('components.activity')

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">

<section class="price" role="region" aria-labelledby="price-heading">
    <h2 id="price-heading" class="price-ttl">Consulter nos tarifs</h2>
    <a class="lnk" href="{{ url('price') }}">
        <button class="price-btn" aria-label="Voir les tarifs">Tarifs</button>
    </a>
</section>

<section class="planning" role="region" aria-labelledby="planning-heading">
    <h2 id="planning-heading" class="planning-ttl">Le planning de la saison</h2>
    <div class="calendar-container">
        <iframe
            src="https://calendar.google.com/calendar/embed?src=e09b979e06d50ef168042d304934557cdd5bbfe5ab641a58a6580213dc8f4058%40group.calendar.google.com&ctz=Africa%2FCeuta&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0"
            class="calendar-frame" aria-label="Calendrier des événements"></iframe>
    </div>
</section>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">

@include('components.actuality')

@include('components.cookie')

@include('components.footer')
