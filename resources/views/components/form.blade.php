<section class="down-form" aria-labelledby="form-main-ttl">

    @if ($errors->any())
        <div class="alert alert-danger" role="alert" aria-live="assertive">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <h2 class="form-main-ttl" id="form-main-ttl">Important</h2>

    <div class="rgpd-info form-txt" aria-label="Informations sur le traitement des données">
        <p class="rgpd-txt1">Les informations recueillies sur ce formulaire sont enregistrées dans un fichier informatisé
            par l'Association Sportive Haie-Vigné. Elles sont conservées pendant la durée de votre inscription et sont
            destinées à l'usage unique des dirigeants de l'association</p>
        <p class="rgpd-txt2">Vous pouvez accéder aux données vous concernant, les rectifier, demander leur effacement ou
            exercer votre droit à la limitation du traitement de vos données. Pour exercer ces droits ou pour toute
            question sur le traitement de vos données, veuillez contacter les dirigeants de l'association.</p>
    </div>

    @if (auth()->check())
        <p class="form-txt">Pour votre inscription veuillez remplir le formulaire en ligne ci dessous </p>
        <p class="form-txt txt">ou</p>
        <p class="form-txt">Télécharger le document PDF ci dessous et le retourner complété à notre adresse</p>
        <div class="link-wrapper">
            <a class="form-lnk" href="{{ asset('documents/Feuille-inscription.pdf') }}" download aria-label="Télécharger le formulaire d'inscription en PDF">
              Télécharger le formulaire
            </a>
          </div>
    @else
        <h2 class="form-main-ttl">Création de compte et inscription</h2>
        <p class="form-txt">Veuillez remplir le formulaire ci-dessous pour créer votre compte et vous inscrire</p>
    @endif

</section>

<img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="" aria-hidden="true">

<form class="form-container" action="{{ route('form.submit') }}" method="POST" enctype="multipart/form-data"
    aria-labelledby="form-title">
    @csrf
    <input type="hidden" name="nonce" value="{{ $nonce }}">
    <h2 class="form-main-ttl" id="form-title" class="visually-hidden">Formulaire d'inscription</h2>
    @auth
        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
    @else
        <input type="hidden" name="firstname" value="{{ session('user_firstname', '') }}">
        <input type="hidden" name="lastname" value="{{ session('user_lastname', '') }}">
        <input type="hidden" name="email" value="{{ session('user_email', '') }}">
    @endauth

    <label class="contact-label" for="first_name" aria-label="Nom">Nom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="first_name" id="first_name" placeholder="Nom" required
        value="{{ auth()->check() ? auth()->user()->lastname : old('first_name') }}" aria-required="true">

    <label class="contact-label" for="last_name" aria-label="Prénom">Prénom :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="last_name" id="last_name" placeholder="Prénom" required
        value="{{ auth()->check() ? auth()->user()->firstname : old('last_name') }}" aria-required="true">

    <label class="contact-label" for="email" aria-label="Email">Email :</label>&ensp;&emsp;
    <input class="contact-input" type="email" name="email" id="email" placeholder="Email" required
        value="{{ auth()->check() ? auth()->user()->email : old('email') }}" aria-required="true">

    @guest
        <label class="contact-label" for="password" aria-label="Mot de passe">Mot de passe :</label>&ensp;&emsp;
        <input class="contact-input" type="password" name="password" id="password" placeholder="Mot de passe" required
            aria-required="true">

        <label class="contact-label" for="password_confirmation" aria-label="Confirmer le mot de passe">Confirmer le mot de
            passe :</label>&ensp;&emsp;
        <input class="contact-input" type="password" name="password_confirmation" id="password_confirmation"
            placeholder="Confirmer le mot de passe" required aria-required="true">
    @endguest

    <label class="contact-label" for="address" aria-label="Adresse">Adresse :</label>&ensp;&emsp;
    <input class="contact-input" type="text" name="address" id="address" placeholder="Adresse postale" required
        value="{{ old('address') }}" aria-required="true">

    <label class="contact-label" for="phone" aria-label="Numéro de téléphone">Numéro de téléphone
        :</label>&ensp;&emsp;
    <input class="contact-input" type="tel" name="phone" id="phone" placeholder="Numéro de téléphone"
        required value="{{ old('phone') }}" aria-required="true">

    <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="" aria-hidden="true">

    <h2 class="form-scd-ttl" id="form-title">Choix des cours :</h2>


    <div class="course-options" role="group" aria-labelledby="form-title">
        <h3 class="course-ttl">Lundi :</h3>
        <div class="course-item">
            <label class="course-type" for="lundi_20h00">Fitness</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" id="lundi_20h00" name="courses[]" value="lundi_20h"
                aria-label="Fitness lundi 20h00-21h00">
        </div>

        <h3 class="course-ttl">Mardi :</h3>
        <div class="course-item">
            <label class="course-type" for="mardi_11h30">Fitness</label>
            <span class="course-time">11h30-12h30</span>
            <input class="course-input" type="checkbox" id="mardi_11h30" name="courses[]" value="mardi_11h30"
                aria-label="Fitness mardi 11h30-12h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="mardi_12h30">Pilates</label>
            <span class="course-time">12h30-13h30</span>
            <input class="course-input" type="checkbox" id="mardi_12h30" name="courses[]" value="mardi_12h30"
                aria-label="Pilates mardi 12h30-13h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="mardi_20h00">Fitness</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" id="mardi_20h00" name="courses[]" value="mardi_20h00"
                aria-label="Fitness mardi 20h00-21h00">
        </div>

        <h3 class="course-ttl">Mercredi :</h3>
        <div class="course-item">
            <label class="course-type" for="mercredi_20h00">Pilates</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" id="mercredi_20h00" name="courses[]" value="mercredi_20h00"
                aria-label="Pilates mercredi 20h00-21h00">
        </div>

        <h3 class="course-ttl">Jeudi :</h3>
        <div class="course-item">
            <label class="course-type" for="jeudi_12h30">Yoga</label>
            <span class="course-time-1">12h30-13h30</span>
            <input class="course-input" type="checkbox" id="jeudi_12h30" name="courses[]" value="jeudi_12h30"
                aria-label="Yoga jeudi 12h30-13h30">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_14h00">Stretching</label>
            <span class="course-time-2">14h00-15h00</span>
            <input class="course-input" type="checkbox" id="jeudi_14h00" name="courses[]" value="jeudi_14h00"
                aria-label="Stretching jeudi 14h00-15h00">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_15h00">Pilates</label>
            <span class="course-time">15h00-16h00</span>
            <input class="course-input" type="checkbox" id="jeudi_15h00" name="courses[]" value="jeudi_15h00"
                aria-label="Pilates jeudi 15h00-16h00">
        </div>
        <div class="course-item">
            <label class="course-type" for="jeudi_20h00">Pilates</label>
            <span class="course-time">20h00-21h00</span>
            <input class="course-input" type="checkbox" id="jeudi_20h00" name="courses[]" value="jeudi_20h00"
                aria-label="Pilates jeudi 20h00-21h00">
        </div>

        <input type="hidden" id="total_input" name="total" value="0">
    </div>

    <div class="total" aria-live="polite">
        <h2 class="form-ttl-total">Total : </h2>
        <p class="total-txt">Montant total : <span id="total"></span> </p>
    </div>

    <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="" aria-hidden="true">

    <h2 class="form-scd-ttl" id="health-questionnaire-title">Questionnaire de santé : </h2>

    <div class="health-questions" role="group" aria-labelledby="health-questionnaire-title">
        <h3 class="form-scd-ttl">Durant les 12 derniers mois :</h3>
        <ul class="question-lst">
            <li class="lst-itm">
                <label class="lst-box" for="question1">Un membre de votre famille est-il décédé subitement d'une cause
                    cardiaque ou inexpliquée ? :</label> <br>
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
                    désensibilisation aux allergies) ? :</label> <br>
                <input type="checkbox" name="health_questions[question6][]" value="oui" id="question6_oui">
                <label for="question6_oui">Oui</label>
                <input type="checkbox" name="health_questions[question6][]" value="non" id="question6_non">
                <label for="question6_non">Non</label>
            </li>
        </ul>
    </div>

    <div class="health-questions" role="group" aria-labelledby="health-questionnaire-today-title">
        <h3 class="form-scd-ttl" id="health-questionnaire-today-title">A ce jour :</h3>
        <ul class="question-lst">
            <li class="lst-itm">
                <label class="lst-box" for="question7">Ressentez vous une douleur, un manque de force ou de raideur
                    suite à un problème osseux, articulaire ou musculaire (fracture, entorse, luxation, déchirure,
                    tendinite, etc...) survenu durent les 12 derniers mois ? :</label> <br>
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
    </div>
    <img class="separation-form" src="{{ asset('asset/img/separation.png') }}" alt="">
    <p class="nbtxt">NB : Les réponses formulés relévent de la seule responsabilité du licencié</p>

    <div class="cond-container" role="region" aria-labelledby="cond-no-title">
        <h3 class="form-scd-ttl" id="cond-no-title">Si vous avez répondu NON à toutes les questions :</h3>
        <p class="cond-txt">Pas de certificat médical à fournir, attestez simplement, selon les modalités prévues par
            la fédéraion, avoir répondu NON à toutes les questions lors de la demande de renouvellement de la licence.
        </p>
    </div>

    <div class="cond-container" role="region" aria-labelledby="cond-yes-title">
        <h3 class="form-scd-ttl" id="cond-yes-title">Si vous avez répondu OUI à une ou plusieurs questions : </h3>
        <p class="cond-txt">Vous devez fournir un certificat médical, consultez un médecin et présentez lui ce
            questionnaire renseigné. (Téléchargement en haut de la page)</p>
    </div>

    <div class="cond-container">
        <label for="file_upload" class="contact-label">Joindre un fichier :</label>
        <input class="contact-input form-up" type="file" name="file_upload" id="file_upload" aria-required="true">
    </div>

    <div class="cond-container">
        <label for="payment_method" class="contact-label">Choisissez votre mode de paiement :</label>
        <select class="contact-input pay-choice" name="payment_method" id="payment_method" required aria-required="true">
            <option value="" disabled selected>--</option>
            <option value="cheque">Chèque bancaire</option>
            <option value="virement">Virement bancaire</option>
            {{-- <option value="carte">Carte bancaire</option>
            <option value="paypal">PayPal</option> --}}
        </select>
    </div>

    <div class="form-group rgpd-consent-container">
        <input type="checkbox" name="rgpd_consent" id="rgpd_consent" required class="rgpd-consent-checkbox">
        <label for="rgpd_consent" class="rgpd-consent-label">
            J'accepte que mes données personnelles soient collectées et traitées conformément à la <br>
            <a href="{{ route('privacy-police') }}" class="rgpd-consent-link">politique de confidentialité</a>.
        </label>
    </div>
    <p class="form-txt">Aprés
        la validation d'inscription vous serez redirigé vers la page des informations de paiement</p>
    <button class="contact-btn" type="submit">S'inscrire</button>
    </form>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', function(e) {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var csrfInput = document.querySelector('input[name="_token"]');
            });
        });
        </script>
