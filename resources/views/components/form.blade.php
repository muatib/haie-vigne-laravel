<section class="down-form">
    <p class="form-ttl">Important</p>
    <p class="form-txt txt">Pour votre inscription veuillez remplir le formulaire en ligne ci dessous <br> <span
            class="alt-txt">ou</span> <br> téléchager le document PDF ci dessous et le retourner complété à notre adresse
    </p>
    <a class="form-lnk" href="{{ asset('documents/Feuille-inscription.pdf') }}" download>Télécharger le formulaire</a>
</section>

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


    <h2>Choix des cours</h2>
    <h3>Nombre de cours par semaine :</h3>
    <div class="course-options">

        <h3 class="course-ttl">Lundi</h3>
        <label class="course-label" for="lundi_20h">Fitness - 20h-21h</label>
        <input class="course-input" type="checkbox" name="courses[]" value="lundi_20h">

        <h3class="course-ttl" >Mardi</h3>
        <label class="course-label" for="mardi_11h30">Fitness - 11h30-12h30</label>
        <input class="course-input" type="checkbox" name="courses[]" value="mardi_11h30"> <br>

        <label class="course-label" for="mardi_12h30">Pilates - 12h30-13h30</label>
        <input class="course-input" type="checkbox" name="courses[]" value="mardi_12h30"> <br>

        <label class="course-label" for="mardi_2Oh00">Fitness - 20h00-21h00</label>
        <input class="course-input" type="checkbox" name="courses[]" value="mardi_20h00">

        <h3 class="course-ttl">Mercredi</h3>
        <label class="course-label" for="mercredi_20h00">Pilates - 20h00-21h00</label>
        <input class="course-input" type="checkbox" name="courses[]" value="mercredi_20h00">

        <h3 class="course-ttl">Jeudi</h3>
        <label class="course-label" for="jeudi_12h30">Yoga - 12h30-13h30</label>
        <input class="course-input" type="checkbox" name="courses[]" value="jeudi_12h30"> <br>


        <label class="course-label" for="jeudi_15h00">Stretching - 14h00-15h00</label>
        <input class="course-input" type="checkbox" name="courses[]" value="jeudi_15h00"> <br>


        <label class="course-label" for="jeudi_15h00">Pilates - 15h00-16h00</label>
        <input type="checkbox" name="courses[]" value="jeudi_15h00"> <br>

        <label class="course-label" for="jeudi_20h00">Pilates - 20h00-21h00</label>
        <input class="course-input" type="checkbox" name="courses[]" value="jeudi_20h00"> <br>
        <input type="hidden" id="total_input" name="total" value="0">

    </div>
    <h2>Total</h2>
    <p>Le total de votre inscription est de : <span id="total"></span> €</p>

    <h2>Questionnaire de santé</h2>
    <div class="health-questions">
        <h3>Durant les 12 derniers mois :</h3>
        <ul>
            <li>
                <label for="question1">Un membre de votre famille est-il décédé subitement d'une cause cardiaque ou
                    inexpliquée ?</label> <br>
                <input type="checkbox" name="question1[]" value="oui"> Oui
                <input type="checkbox" name="question1[]" value="non"> Non
            </li>
            <li>
                <label for="question2">Avez-vous ressenti une douleur dans la poitrine, des palpitations, un
                    essoufflement inhabituel ou un malaise ?</label> <br>
                <input type="checkbox" name="question2[]" value="oui"> Oui
                <input type="checkbox" name="question2[]" value="non"> Non
            </li>
            <li>
                <label for="question3">Avez-vous eu un épisode de respiration sifflante (asthme) ?</label> <br>
                <input type="checkbox" name="question3[]" value="oui"> Oui
                <input type="checkbox" name="question3[]" value="non"> Non
            </li>
            <li>
                <label for="question4">Avez-vous eu une perte de connaissance ?</label> <br>
                <input type="checkbox" name="question4[]" value="oui"> Oui
                <input type="checkbox" name="question4[]" value="non"> Non
            </li>
            <li>
                <label for="question5">Si vous avez arrêté le sport pendant 30 jours ou plus pour des raisons de santé,
                    avez vous repris sans l'accord d'un médecin ?</label> <br>
                <input type="checkbox" name="question5[]" value="oui"> Oui
                <input type="checkbox" name="question5[]" value="non"> Non
            </li>
            <li>
                <label for="question6">Avez-vous débuté un traitement médical de longue durée (hors contraception et
                    désensibilisation aux allérgies) ?</label> <br>
                <input type="checkbox" name="question6[]" value="oui"> Oui
                <input type="checkbox" name="question6[]" value="non"> Non
            </li>
        </ul>
    </div>


    <div class="health-questions">
        <h3>A ce jour :</h3>
        <ul>
            <li>
                <label for="question7">Ressentez vous une douleur, un manque de force ou de raideur suite à un problème
                    osseux, articulaire ou musculaire (fracture, entorse, luxation, déchirure, tendinite, etc...)
                    survenu durent les 12 derniers mois ?</label> <br>
                <input type="checkbox" name="question7[]" value="oui"> Oui
                <input type="checkbox" name="question7[]" value="non"> Non
            </li>
            <li>
                <label for="question8">Votre pratique sportive est-elle interrompue pour des raisons de santé ?</label>
                <br>
                <input type="checkbox" name="question8[]" value="oui"> Oui
                <input type="checkbox" name="question8[]" value="non"> Non
            </li>
            <li>
                <label for="question9">Pensez vous avoir besoin d'un avis médical pour poursuivre votre pratique
                    sportive ?</label> <br>
                <input type="checkbox" name="question9[]" value="oui"> Oui
                <input type="checkbox" name="question9[]" value="non"> Non
            </li>
        </ul>


    </div>
    <p class="question-nbtxt">NB : Les réponses formulés relévent de la seule responsabilité du licencié</p>
    <div>
        <h3>Si vous avez répondu NON à toutes les questions :</h3>
        <p>Pas de cvertificat médical à fournir, attestez simplement, selon les modalités prévues par la fédéraion,
            avoir répondu NON à toutes les questions lors de la demande de renouvellement de la licence.</p>
    </div>
    <div>h3>Si vous avez répondu OUI à une ou plusieurs questions : </h3>
        <p>Vous devez fournir un certificat médical, consultez un médecin et présentez lui ce questionnaire renseigné.
        </p>
    </div>
    < <label for="file_upload" class="contact-label">Certificat médical :</label>
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

        <p class="form-txt">Aprés
            la validation d'inscription vous serez redirigé vers la page de paiement</p>
        <button class="contact-btn" type="submit">S'inscrire</button>
</form>
