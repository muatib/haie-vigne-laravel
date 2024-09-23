@include('components.header')

<img class="img-up" src="{{ asset('asset/img/Vector 1.png') }}" alt="">

<h1 class="main-ttl">L'association en quelques mots</h1>

<div class="main-txt-container">
    <p class="main-txt-itm">Le club fait parti de la FFEPGV, Fédération Française d’Education Physique et Gymnastique Volontaire, issue d’un mouvement né à la fin du 19ème siècle. La fédération compte plus de 546 000 licenciés et elle est la 5ème plus importante fédération française sportive.</p>

    <p class="main-txt-itm">Notre club a été créé en octobre 1991, en mai 2017 le club a obtenu le label E.P.G.V "Qualité club sport santé" .</p>

    <p class="main-txt-itm">Tous nos animateurs sont des professionnels du sport.</p>

    <p class="main-txt-itm">Buts et objectifs de l’association :</p>

    <p class="main-txt-itm">- proposer un large choix de séances en termes d’activités et d’horaires</p>

    <p class="main-txt-itm">- lutter contre la sédentarité</p>

    <p class="main-txt-itm">- favoriser le lien social en associant loisir et bien être afin de conserver vitalité et élan pour la vie dans une société où forme, bien être, longévité, convivialité et plaisir sont très recherchés.</p>
</div>
<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">

<section class="activity-slider">
    <h2 class="slider-ttl">Les activités de l'association</h2>
    <div class="slide-container">
        <img class="slide-image" src="{{ asset('asset/img/yoga.png') }}" alt="yoga">
        <button class="slider-left-arrow"><</button>
        <button class="slider-btn">En savoir plus</button>
        <button class="slider-right-arrow">></button>
    </div>
    <div class="slide-container">
        <img class="slide-image" src="{{ asset('asset/img/fitness.png') }}" alt="fitness">
        <button class="slider-left-arrow"><</button>
        <button class="slider-btn">En savoir plus</button>
        <button class="slider-right-arrow">></button>
    </div>
    <div class="slide-container">
        <img class="slide-image" src="{{ asset('asset/img/pilates.png') }}" alt="pilates">
        <button class="slider-left-arrow"><</button>
        <button class="slider-btn">En savoir plus</button>
        <button class="slider-right-arrow">></button>
    </div>
    <div class="slide-container">
        <img class="slide-image" src="{{ asset('asset/img/stretching.png') }}" alt="stretching">
        <button class="slider-left-arrow"><</button>
        <button class="slider-btn">En savoir plus</button>
        <button class="slider-right-arrow">></button>
    </div>
    <div class="slide-container">
        <img class="slide-image" src="{{ asset('asset/img/gym.png') }}" alt="gym douce">
        <button class="slider-left-arrow"><</button>
        <button class="slider-btn">En savoir plus</button>
        <button class="slider-right-arrow">></button>
    </div>
</section>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="">

<section class="price">
    <H2 class="price-ttl">Consuter nos tarifs</H2>
    <a href="{{ url('price') }}"><button class="price-btn">Tarifs</button></a>
</section>

<section class="planning">
    <h2 class="planning-ttl">Le planning de la saison</h2>
    <div class="calendar-container">
        <iframe src="https://calendar.google.com/calendar/embed?src=e09b979e06d50ef168042d304934557cdd5bbfe5ab641a58a6580213dc8f4058%40group.calendar.google.com&ctz=Africa%2FCeuta&showTitle=0&showNav=1&showDate=1&showPrint=0&showTabs=1&showCalendars=0&showTz=0" class="calendar-frame"></iframe>
    </div>
</section>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">

<section class="actuality-slider">
    <h2 class="planning-ttl">Notre actualité</h2>
    <div class="slider-container">
        <img class="slider-image" src="{{ asset('asset/img/event.png') }}" alt="event">
        <button class="slide-left-arrow"><</button>
        <button class="slide-btn">En savoir plus</button>
        <button class="slide-right-arrow">></button>
    </div>
    <div class="slider-container">
        <img class="slider-image" src="{{ asset('asset/img/event 2.jpg') }}" alt="event">
        <button class="slide-left-arrow"><</button>
        <button class="slide-btn">En savoir plus</button>
        <button class="slide-right-arrow">></button>
    </div>
    <div class="slider-container">
        <img class="slider-image" src="{{ asset('asset/img/event 3.jpg') }}" alt="event">
        <button class="slide-left-arrow"><</button>
        <button class="slide-btn">En savoir plus</button>
        <button class="slide-right-arrow">></button>
    </div>
</section>

<script type="text/javascript" src="https://cookieconsent.popupsmart.com/src/js/popper.js"></script>
<script>
    window.start.init({
        Palette: "palette6",
        Mode: "floating left",
        Theme: "block",
        Message: "Notre site utilise de délicieux cookies afin de garantir la sécurité de vos données personnelles et une navigation optimale.",
        ButtonText: "Compris !",
        LinkText: "En savoir plus",
        Time: "5",
    })
</script>
</body>
@include('components.footer')


</html>
