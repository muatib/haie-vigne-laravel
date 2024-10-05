@include('components.header')

<div class="user-account-container">
    <h1>Mon compte</h1>
    <p>Bienvenue, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }} !</p>

    <!-- Informations du compte -->
    <div class="account-info">
        <p>Email : {{ Auth::user()->email }}</p>
        <!-- Ajoutez d'autres informations du compte ici si nécessaire -->
    </div>

    <!-- Bouton de déconnexion -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">Se déconnecter</button>
    </form>
</div>



@include('components.footer')
