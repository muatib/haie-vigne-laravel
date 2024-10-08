@include('components.header')


@foreach ($sliderImages2 as $index => $image)
    <section id="actuality-box-{{ $index + 1 }}" class="actuality-box">
        @if ($index == 0)
            <h1 class="actuality-ttl">Cours de yoga vygnasa doux</h1>
            <p class="actuality-txt">Détente du corps et de l'esprit</p>
            <img class="actuality-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="actuality-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="pilate-content">
                <div class="pilate-left">
                    <h4>1 cours :</h4>
                    <p>Le lundi de 12h30 à 13h30</p>
                </div>
                <div class="pilate-right">
                    <h4>coaché par :</h4>
                    <p>Nathalie Bon</p>
                </div>
            </div>
            <p class="actuality-txt">Mouvements coordonnés à la respiration, postures, enchaînements de postures, relaxation....</p>
            <p class="actuality-txt">Assouplit et tonifie le corps.</p>
        @elseif ($index == 1)
            <h1 class="actuality-ttl">Cours de pilates</h1>
            <p class="actuality-txt">Amélioration de la souplesse et de la coordination, harmonie du corps et de l'esprit, détente et relaxation.</p>
            <img class="actuality-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="actuality-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="pilate-content">
                <div class="pilate-left">
                    <h4>4 cours :</h4>
                    <p>Le mardi de 12h30 à 13h30</p>
                    <p>Le mercredi de 20h à 21h</p>
                    <p>Le jeudi de 15h à 16h</p>
                    <p>Le jeudi de 20h à 21h</p>
                </div>
                <div class="pilate-right">
                    <h4>coachés par :</h4>
                    <p>Delphine Vattier</p>
                    <p>Nathalie Bon</p>
                    <p>Maud Lemoine</p>
                    <p>Julie Noblet</p>
                </div>
            </div>
            <p class="actuality-txt">Méthode de remise en forme globale basée sur des excercices doux aynat pour objectif de renforcer les muscles profons essentiels à une bonne posture.</p>
            <p class="actuality-txt">Cours visant à muscler harmonieusement toutes les parties du corps, avec une mention spéciale pour les abdominaux qui sont travaillés en profondeur.</p>
        @elseif ($index == 2)
            <h1 class="actuality-ttl">Cours de fitness</h1>
            <p class="actuality-txt">Cours de GYM' fitness : <br> remise en forme et entretient.</p>
            <img class="actuality-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="actuality-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="pilate-content">
                <div class="pilate-left">
                    <h4>3 cours :</h4>
                    <p>Le lundi de 20h à 21h</p>
                    <p>Le mardi de 11h30 à 12h30</p>
                    <p>Le mardi de 20h à 21h</p>
                </div>
                <div class="pilate-right">
                    <h4>coachés par :</h4>
                    <p>Léa Huchet</p>
                    <p>Evelyne Bertrand</p>
                    <p> </p>
                </div>
            </div>
            <p class="actuality-txt">Renforcement musculaire (abdos, fessiers...) enchaînements dansés pour certains cours, coordination, étirements. <br> Permet de travailler efficacement le corps.</p>
        @endif
    </section>
@endforeach




@include('components.footer')
