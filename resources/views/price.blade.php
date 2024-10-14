@include('components.header')

<img class="img-up" src="{{ asset('asset/img/Vector 1.png') }}" alt="Illustration des tarifs">
<h1 class="main-ttl" id="pricing-title">Tarifs saison 2023 / 2024</h1>

<section class="price-container" role="region" aria-labelledby="pricing-title">
    <div class="price-txt" aria-label="Tarifs par nombre de cours">
        <p>- 1 cours semaine : </p>
        <p>- 2 cours semaine : </p>
        <p>- 3 cours semaine : </p>
        <p>- 4 cours et + semaine : </p>
    </div>
    <div class="price-nb" aria-label="Montants des tarifs">
        <p>136 €</p>
        <p>216 €</p>
        <p>276 €</p>
        <p>326 €</p>
    </div>
</section>

<a class="lnk" href="{{ route('form') }}">
    <button class="price-btn" aria-label="Inscription aux cours">S'inscrire ici</button>
</a>

<section class="price-rule-txt" role="region" aria-labelledby="price-rules">
    <h2 id="price-rules" class="price-rule-ttl">Important : </h2>
    <p class="rule-txt">- Les inscriptions se font au moment des cours, elles sont possibles tout au long de l'année.
    </p>
    <p class="rule-txt">- Tarifs dégressifs en fonction du trimestre d'inscription, les tarifs comprennent 25€ de
        licence.</p>
    <p class="rule-txt">- Réduction étudiant et demandeur d'emploi de 10€ sur présentation de justificatif.</p>
    <p class="rule-txt">- Nous acceptons les chèques ANCV, les coupons sports.</p>
    <p class="rule-txt">- Possibilités de paiement en plusieurs fois par chèque.</p>
</section>

<a class="lnk" href="{{ route('form') }}">
    <button class="price-btn" aria-label="Inscription aux cours">S'inscrire ici</button>
</a>

@include('components.footer')
