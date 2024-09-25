<form class="form-container" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="contact-label" for="name">Nom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="first_name" placeholder="Nom" required>
    <label class="contact-label" for="last_name">Prénom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="last_name" placeholder="Prénom" required>
    <label class="contact-label" for="email">Email :</label>&ensp;&emsp;
    <input class="contact-input" type="email" name="email" placeholder="Email" required>
    <label class="contact-label" for="adress">Adresse :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="address" placeholder="Adresse postale" required>
    <label class="contact-label" for="phone">Numéro de téléphone :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="phone" placeholder="Numéro de téléphone" required>
    <label for="file_upload" class="contact-label">Fichier à télécharger :</label>
    <input class="contact-input form-up" type="file" name="file_upload">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <p class="form-txt">Aprés la validation d'inscription vous serez redirigé vers la page de paiement</p>
    <button class="contact-btn" type="submit">S'inscrire</button>
</form>
