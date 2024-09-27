<section class="down-form">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <p class="form-main-txt">Important</p>
    <p class="form-txt ">Pour votre inscription veuillez remplir le formulaire en ligne ci dessous </p>
    <p class="form-txt txt">ou</p>
    <p class="form-txt ">Téléchager le document PDF ci dessous et le retourner complété à notre adresse</p>
    <a class="form-lnk" href="{{ asset('documents/Feuille-inscription.pdf') }}" download>Télécharger le formulaire</a>
</section>

<img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">
<form class="form-container" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label class="contact-label" for="name">Nom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="first_name" placeholder="Nom" required
        value="{{ old('first_name') }}">
    <label class="contact-label" for="last_name">Prénom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="last_name" placeholder="Prénom" required
        value="{{ old('last_name') }}">
    <label class="contact-label" for="email">Email :</label>&ensp;&emsp;
    <input class="contact-input" type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
    <label class="contact-label" for="adress">Adresse :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="address" placeholder="Adresse postale" required
        value="{{ old('address') }}">
    <label class="contact-label" for="phone">Numéro de téléphone :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="phone" placeholder="Numéro de téléphone" required
        value="{{ old('phone') }}">
    <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">

    <h2 class="form-ttl">Choix des cours :</h2>
    <h3 class="form-scd-ttl">Nombre de cours par semaine :</h3>

    <div class="course-options">
        <h3 class="course-ttl">Lundi :</h3>
        <div class="course-item">
            <label class="course-type" for="lundi_20h00">Fitness</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="lundi_20h">
        </div>

        <h3 class="course-ttl">Mardi :</h3>
        <div class="course-item">
            <label class="course-type" for="mardi_11h30">Fitness</label>
            <span class="course-time">11h30-12h30</span>
            <input class="course-input" type="checkbox" name="courses[]" value="mardi_11h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="mardi_12h30">Pilates</label>
            <span class="course-time">12h30-13h30</span>
            <input class="course-input" type="checkbox" name="courses[]" value="mardi_12h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="mardi_20h00">Fitness</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="mardi_20h00">
        </div>

        <h3 class="course-ttl">Mercredi :</h3>
        <div class="course-item">
            <label class="course-type" for="mercredi_20h00">Pilates</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="mercredi_20h00">
        </div>

        <h3 class="course-ttl">Jeudi :</h3>
        <div class="course-item">
            <label class="course-type" for="jeudi_12h30">Yoga</label>
            <span class="course-time-1">12h30-13h30</span>
            <input class="course-input" type="checkbox" name="courses[]" value="jeudi_12h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_14h00">Stretching</label>
            <span class="course-time-2">14h00-15h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="jeudi_14h00">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_15h00">Pilates</label>
            <span class="course-time">15h00-16h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="jeudi_15h00">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_20h00">Pilates</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" name="courses[]" value="jeudi_20h00">
        </div>
        <input type="hidden" id="total_input" name="total" value="0">
    </div>
    <div class="total">
        <h2 class="form-ttl-total">Total : </h2>
        <p class="total-txt">Montant total : <span id="total"></span> </p>
    </div>
    <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">

    <h2 class="form-ttl">Questionnaire de santé : </h2>
    <div class="health-questions">
        <h3 class="form-scd-ttl">Durant les 12 derniers mois :</h3>
        <ul class="question-lst">
            <li class="lst-itm">

                    <label class="lst-box" for="question1">Un membre de votre famille est-il décédé subitement d'une cause cardiaque ou inexpliquée ? :</label> <br>
                    <input type="checkbox" name="health_questions[question1][]" value="oui" id="question1_oui">
                    <label for="question1_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question1][]" value="non" id="question1_non">
                    <label for="question1_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question2">Avez-vous ressenti une douleur dans la poitrine, des
                    palpitations, un
                    essoufflement inhabituel ou un malaise ? :</label> <br>
                    <input type="checkbox" name="health_questions[question2][]" value="oui" id="question2_oui">
                    <label for="question2_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question2][]" value="non" id="question2_non">
                    <label for="question2_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question3">Avez-vous eu un épisode de respiration sifflante (asthme) ?
                    :</label> <br>
                    <input type="checkbox" name="health_questions[question3][]" value="oui" id="question3_oui">
                    <label for="question3_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question3][]" value="non" id="question3_non">
                    <label for="question3_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question4">Avez-vous eu une perte de connaissance ? :</label> <br>
                <input type="checkbox" name="health_questions[question4][]" value="oui" id="question4_oui">
                    <label for="question4_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question4][]" value="non" id="question4_non">
                    <label for="question4_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question5">Si vous avez arrêté le sport pendant 30 jours ou plus pour des
                    raisons de santé,
                    avez vous repris sans l'accord d'un médecin ? :</label> <br>
                    <input type="checkbox" name="health_questions[question5][]" value="oui" id="question5_oui">
                    <label for="question5_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question5][]" value="non" id="question5_non">
                    <label for="question5_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question6">Avez-vous débuté un traitement médical de longue durée (hors
                    contraception et
                    désensibilisation aux allérgies) ? :</label> <br>
                    <input type="checkbox" name="health_questions[question6][]" value="oui" id="question6_oui">
                    <label for="question6_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question6][]" value="non" id="question6_non">
                    <label for="question6_non">Non</label>
            </li>
        </ul>
    </div>


    <div class="health-questions">
        <h3 class="form-scd-ttl">A ce jour :</h3>
        <ul class="question-lst">
            <li class="lst-itm">
                <label class="lst-box" for="question7">Ressentez vous une douleur, un manque de force ou de raideur
                    suite à un problème
                    osseux, articulaire ou musculaire (fracture, entorse, luxation, déchirure, tendinite, etc...)
                    survenu durent les 12 derniers mois ? :</label> <br>
                    <input type="checkbox" name="health_questions[question7][]" value="oui" id="question7_oui">
                    <label for="question7_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question7][]" value="non" id="question7_non">
                    <label for="question7_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question8">Votre pratique sportive est-elle interrompue pour des raisons
                    de santé ? :</label>
                <br>
                <input type="checkbox" name="health_questions[question8][]" value="oui" id="question8_oui">
                    <label for="question8_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question8][]" value="non" id="question8_non">
                    <label for="question8_non">Non</label>
            </li>
            <li class="lst-itm">
                <label class="lst-box" for="question9">Pensez vous avoir besoin d'un avis médical pour poursuivre
                    votre pratique
                    sportive ? :</label> <br>
                    <input type="checkbox" name="health_questions[question9][]" value="oui" id="question9_oui">
                    <label for="question9_oui">Oui</label>
                    <input type="checkbox" name="health_questions[question9][]" value="non" id="question9_non">
                    <label for="question9_non">Non</label>
            </li>
        </ul>
        <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">

    </div>
    <p class="nbtxt">NB : Les réponses formulés relévent de la seule responsabilité du licencié</p>
    <div class="cond-container">
        <h3 class="form-scd-ttl">Si vous avez répondu NON à toutes les questions :</h3>
        <p class="cond-txt">Pas de cvertificat médical à fournir, attestez simplement, selon les modalités prévues par
            la fédéraion,
            avoir répondu NON à toutes les questions lors de la demande de renouvellement de la licence.</p>
    </div>
    <div class="cond-container">
        <h3 class="form-scd-ttl">Si vous avez répondu OUI à une ou plusieurs questions : </h3>
        <p class="cond-txt">Vous devez fournir un certificat médical, consultez un médecin et présentez lui ce
            questionnaire renseigné.
        </p>
    </div>


    < <label for="file_upload" class="contact-label">Certificat médical :</label>
        <input class="contact-input form-up" type="file" name="file_upload">





        <p class="form-txt">Aprés
            la validation d'inscription vous serez redirigé vers la page de paiement</p>
        <button class="contact-btn" type="submit">S'inscrire</button>
</form>
