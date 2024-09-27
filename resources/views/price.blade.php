@include('components.header')

    <img class="img-up" src="{{ asset('asset/img/Vector 1.png') }}" alt="">
    <h1 class="main-ttl">Tarifs saison 2023 / 2024</h1>

    <section class="price-container">
        <div class="price-txt">
            <p>- 1 cours semaine : </p>
            <p>- 2 cours semaine : </p>
            <p>- 3 cours semaine : </p>
            <p>- 4 cours et + semaine : </p>
        </div>
        <div class="price-nb">
            <p>136 €</p>
            <p>216 €</p>
            <p>276 €</p>
            <p>326 €</p>
        </div>
    </section>
    <a class="lnk" href="{{ route('form') }}"><button class="price-btn">S'inscrire ici</button></a>
    <section class="price-rule-txt">
        <h2 class="price-rule-ttl">Important : </h2>
        <p class="rule-txt">- Les inscriptions se font au moment des cours, elles sont possibles tout au long de l'année.</p> <br>
        <p class="rule-txt">- Tarifs dégressifs en fonction du trimestre d'inscription, les tarifs comprennent 36€ pour la licence.</p> <br>
        <p class="rule-txt"> - Réduction étudiant et demandeur d'emploi de 10€ sur présentation de justificatif.</p> <br>
        <p class="rule-txt">- Nous acceptons les chèques ANCV, les coupons sports. </p><br>
        <p class="rule-txt">- Pour les 17 ans dispositif "Pass Sport" (de septembre à au 31 octobre 2021). </p><br>
        <p class="rule-txt">- Possibilités de paiement en plusieurs fois. </p>
    </section>
    <a class="lnk" href="{{ route('form') }}"><button class="price-btn">S'inscrire ici</button></a>

    @include('components.footer')

</body>
</html>
