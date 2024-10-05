@include('components.header')


<div class="container">
    <h1>Tableau de bord administrateur</h1>
    <p>Bienvenue, {{ auth()->user()->firstname }} {{ auth()->user()->lastname }}!</p>


@include('components.footer')
