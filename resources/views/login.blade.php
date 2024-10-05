@include('components.header')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<h2 class="reg-ttl" class="users-ttl">Se connecter</h2>
<form class="form-container" method="POST" action="{{ route('login') }}">
    @csrf


        <label class="log-label" for="email">Email</label>
        <input class="reg-input"  id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror



        <label class="log-label" for="password">Mot de passe</label>
        <input class="reg-input" id="password" type="password" name="password" required>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror



    <div>
        <button class="log-btn" type="submit">Connexion</button>
    </div>
</form>

@include('components.footer')
