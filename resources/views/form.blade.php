@include('components.header')


@vite(['resources/js/burger.js', 'resources/js/form.js'])

<h1 class="contact-ttl">Formulaire d'inscription</h1>
<img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">

@include('components.form')


</body>
@include('components.footer')


</html>
