@include('components.header')


<section id="register">
    <h2 class="reg-ttl" class="users-ttl">Créer votre compte</h2>
    @if ($errors->any())
        <div class="error-message">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @elseif (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    <form class="form-container" action="{{ route('register') }}" method="post" enctype="multipart/form-data">
        @csrf

        <label class="reg-label" for="firstname">Nom:</label>
        <input class="reg-input" type="text" id="firstname" name="firstname" required
            value="{{ old('firstname') }}">


        <label class="reg-label"  for="lastname">Prénom:</label>
        <input class="reg-input"  type="text" id="lastname" name="lastname" required value="{{ old('lastname') }}">


        <label class="reg-label" for="email">Email:</label>
        <input class="reg-input" type="email" id="email" name="email" required value="{{ old('email') }}">


        <label class="reg-label" for="password">Mot de passe:</label>
        <input class="reg-input" type="password" id="password" name="password" required>



        <label class="reg-label" for="password-check">Répéter le mot de passe:</label>
        <input class="reg-input" type="password" id="password-check" name="password_confirmation" required>

        <div class="term">
            <input class="term-chck" type="checkbox" id="accept-terms" name="accept-terms" required>
            <label class="term-txt" for="accept-terms">J'accepte les <a class="term-lnk " href="#" target="_blank">conditions
                    d'utilisation</a></label>
        </div>


        <button class="contact-btn" type="submit" name="register_submit" class="btn">Créer le compte</button>
    </form>
</section>
@include('components.footer')
