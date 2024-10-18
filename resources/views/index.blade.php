
<title>Association Sport et Bien-Être Haie-Vigné | Activités sportives à Caen</title>
@include('components.header')

<img class="img-up" src="{{ asset('asset/img/Vector 1.png') }}" alt="Décoration page Haie-Vigné" aria-hidden="true">

@php
    $isAuthenticated = auth()->check();
    $user = auth()->user();
    $isAdmin = $user ? $user->is_admin : false;
@endphp

<h1 class="main-ttl" aria-label="Présentation de l'association">Bienvenue sur le site de l'association sport et bien être Haie-vigné</h1>

<div class="main-txt-container" role="main">
    <p class="main-txt-itm" aria-label="Historique de la Fédération">
        L'association existe depuis 1991.

        En 2023, nous avons changé de nom 'Association Sport et Bien-Etre Haie Vigné'.

        Nous avons rejoint <a href="https://www.ufolep.org/">la fédération
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

    <p class="main-txt-itm">Tous nos animateurs sont des professionnels du sport.</p>
    </p>

    <h2 class="actuality-main-ttl" aria-label="Buts et objectifs">
        Buts et objectifs de l’association :
    </h2>

    <ul class="main-txt-itm" aria-label="Liste des objectifs de l'association">
        <li>- Proposer un large choix de séances en termes d’activités et d’horaires</li>
        <li>- Lutter contre la sédentarité</li>
        <li>- Favoriser le lien social en associant loisir et bien-être <br> afin de conserver vitalité et élan pour la vie
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
<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">
<h2 id="planning-heading" class="calendar-ttl">Le planning de la saison</h2>
<section class="planning" role="region" aria-labelledby="planning-heading">
    <div class="calendar-container">
        <iframe
            src="https://calendar.google.com/calendar/embed?src=e09b979e06d50ef168042d304934557cdd5bbfe5ab641a58a6580213dc8f4058%40group.calendar.google.com&ctz=Africa%2FCeuta&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0"
            class="calendar-frame" aria-label="Calendrier des événements"></iframe>
    </div>
</section>
<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">
<h2 class="map-ttl">Ou nous trouver</h2>
<div class="map-container">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2607.927540085867!2d-0.38758978773338193!3d49.18296157125868!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x480a42ddfd1d31a9%3A0xfafc76fdcd7e9f2c!2sCentre%20Sportif%20La%20Haie%20Vign%C3%A9!5e0!3m2!1sfr!2sfr!4v1728918163537!5m2!1sfr!2sfr"
            frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
  </div>
<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="Séparation visuelle" aria-hidden="true">

<h2 class="actuality-main-ttl">Notre actualité</h2>
@include('components.actuality')






@include('components.cookie')

@include('components.footer')
