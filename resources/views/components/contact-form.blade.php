

<div class="contact-container">
<form class="form-container " action="{{ route('contact.submit') }}" method="post">
    @csrf
    <label class="message-form-label" for="name">Nom</label>
    <input class="message-form-input" type="text" name="name" id="name" placeholder="Votre nom" required>
    <label class="message-form-label" for="email">Email</label>
    <input class="message-form-input" type="email" name="email" id="email" placeholder="Votre adresse mail" required>
    <label class="message-label" for="message">Votre message</label>
    <textarea class="message-input" name="message" id="message" placeholder="Entrez votre message ici" required></textarea>
    <button class="contact-btn">Envoyer</button>
</form>
</div>
