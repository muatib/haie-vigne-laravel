@include('components.header')

<h1 class="pay-ttl">Page de paiement</h1>
<h2 class="pay-scdttl">. 1 - Par chéque bancaire libéllé à l'ordre :</h2>
<p class="pay-txt">GV Haie-Vigné</p>
<p class="pay-txt">(Paiement en plusieurs chèques possible)</p>

<h2 class="pay-scdttl">. 2 - Par virement à cet IBAN : </h2>
<p class="pay-txt">0000 0000 0000 0000 000</p>

{{-- <h2 class="pay-scdttl">. 3 - Par Carte Bancaire : </h2>
<img class="CB" src="{{ asset('asset/img/LogoCB.jpg') }}" alt="">

<h2 class="pay-scdttl">. 4 - Par PayPal : </h2>
<img class="paypal" src="{{ asset('asset/img/PayPalCard.png') }}" alt=""> --}}


</body>
@include('components.footer')


</html>
