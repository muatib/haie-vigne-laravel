@include('components.header')

@if (session('success'))
    <div class="alert alert-success" role="alert" aria-live="polite">
        {{ session('success') }}
    </div>
@endif

<h2 class="reg-ttl" id="login-title">Se connecter</h2>

<form class="form-container" method="POST" action="{{ route('login') }}" aria-labelledby="login-title">
    @csrf

    <label class="log-label" for="email">Email</label>
    <input class="reg-input" id="email" type="email" name="email" value="{{ old('email') }}" required autofocus aria-required="true" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}">
    @error('email')
        <span class="invalid-feedback" role="alert" aria-live="assertive">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <label class="log-label" for="password">Mot de passe</label>
    <input class="reg-input" id="password" type="password" name="password" required aria-required="true" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
    @error('password')
        <span class="invalid-feedback" role="alert" aria-live="assertive">
            <strong>{{ $message }}</strong>
        </span>
    @enderror

    <div>
        <button class="log-btn" type="submit" aria-label="Bouton de connexion">Connexion</button>
    </div>
</form>

@include('components.footer')
