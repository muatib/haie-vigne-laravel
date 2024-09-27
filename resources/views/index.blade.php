@include('components.header')

<img class="img-up" src="{{ asset('asset/img/Vector 1.png') }}" alt="">

<h1 class="main-ttl">L'association en quelques mots</h1>

<div class="main-txt-container">
    <p class="main-txt-itm">Le club fait parti de la FFEPGV, Fédération Française d’Education Physique et Gymnastique Volontaire, issue d’un mouvement né à la fin du 19ème siècle. La fédération compte plus de 546 000 licenciés et elle est la 5ème plus importante fédération française sportive.</p>

    <p class="main-txt-itm">Notre club a été créé en octobre 1991, en mai 2017 le club a obtenu le label E.P.G.V "Qualité club sport santé" .</p>

    <p class="main-txt-itm">Tous nos animateurs sont des professionnels du sport.</p>

    <p class="main-txt-itm">Buts et objectifs de l’association :</p>

    <p class="main-txt-itm">- Proposer un large choix de séances en termes d’activités et d’horaires</p>

    <p class="main-txt-itm">- Lutter contre la sédentarité</p>

    <p class="main-txt-itm">- Favoriser le lien social en associant loisir et bien être afin de conserver vitalité et élan pour la vie dans une société où forme, bien être, longévité, convivialité et plaisir sont très recherchés.</p>
</div>
<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">

@include('components.activity')

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="">

<section class="price">
    <H2 class="price-ttl">Consuter nos tarifs</H2>
    <a class="lnk" href="{{ url('price') }}"><button class="price-btn">Tarifs</button></a>
</section>

<section class="planning">
    <h2 class="planning-ttl">Le planning de la saison</h2>
    <div class="calendar-container">
        <iframe src="https://calendar.google.com/calendar/embed?src=e09b979e06d50ef168042d304934557cdd5bbfe5ab641a58a6580213dc8f4058%40group.calendar.google.com&ctz=Africa%2FCeuta&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0" class="calendar-frame"></iframe>
    </div>
</section>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">

@include('components.actuality')

@include('components.cookie')
</body>
@include('components.footer')


</html>
