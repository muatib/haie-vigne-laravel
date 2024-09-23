@include('components.header')

<h1 class="contact-ttl">Formulaire de contact</h1>

<form class="form-container" action="#" method="post">
    @csrf
    <label class="contact-label" for="name">Nom</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="name" id="name" placeholder="Votre nom" required>
    <label class="contact-label" for="email">Email</label>&ensp;&emsp;
    <input class="contact-input" type="email" name="email" id="email" placeholder="Votre adresse mail" required>
    <label class="message-label" for="message">Votre message</label>
    <textarea class="message-input" name="message" id="message" placeholder="Entrez votre message ici" required></textarea>
    <button class="contact-btn">Envoyer</button>
</form>

@include('components.footer')

</body>

</html
