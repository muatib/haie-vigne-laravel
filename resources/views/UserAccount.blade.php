@include('components.header')

<div class="user-account-container">
    <h1 class="acc-ttl">Mon compte</h1>
    <p class="acc-txt">Bienvenue : {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} </p>

    <!-- Informations du compte -->
    <div class="account-info">
        <p class="acc-txt">Email : {{ Auth::user()->email }}</p>
        <!-- Ajoutez d'autres informations du compte ici si nécessaire -->
    </div>

    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button class="price-btn" type="submit" class="logout-btn">Se déconnecter</button>
    </form>
</div>



@include('components.footer')
