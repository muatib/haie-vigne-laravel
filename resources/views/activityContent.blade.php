@include('components.header')

{{--
@foreach ($images as $index => $image)
    <section id="activity-box-{{ $index + 1 }}" class="activity-box">
        @if ($index == 0)
            <h1 class="activity-ttl">Cours de yoga vygnasa doux</h1>
            <p class="activity-txt">Détente du corps et de l'esprit</p>
            <img class="activity-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="activity-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="box-content">
                <div class="box-left">
                    <h4>1 cours :</h4>
                    <p>Le lundi de 12h30 à 13h30</p>
                </div>
                <div class="box-right">
                    <h4>coaché par :</h4>
                    <p>Nathalie Bon</p>
                </div>
            </div>
            <p class="activity-txt">Mouvements coordonnés à la respiration, postures, enchaînements de postures,
                relaxation....</p>
            <p class="activity-txt">Assouplit et tonifie le corps.</p>
        @elseif ($index == 1)
            <h1 class="activity-ttl">Cours de gym'douce</h1>
            <p class="activity-txt">gym'douce "bien vieillir".</p>
            <p class="activity-txt">Plus qu'une simple activité physique, <br> c'est un moment de convivialité et de
                partage.</p>
            <img class="activity-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="activity-txt">A la maison de quartier St Paul <br> 30 rue Secqueville..</p>
            <div class="box-content">
                <div class="box-left">
                    <h4>1 cours :</h4>
                    <p>Le mardi de 10h30 à 11h30</p>
                </div>
                <div class="box-right">
                    <h4>coaché par :</h4>
                    <p>Julie Noblet</p>
                </div>
            </div>
            <p class="activity-txt">Entretien de la condition physique, souplesse, force musculaire, stimulation de la
                mémoire et de l'équilibre.</p>
            <p class="activity-txt">Des scéances adaptées à tous en focntion des capacités de chacun.</p>
        @elseif ($index == 2)
            <h1 class="activity-ttl">Cours de fitness</h1>
            <p class="activity-txt">Cours de GYM' fitness : <br> remise en forme et entretient.</p>
            <img class="activity-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="activity-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="box-content">
                <div class="box-left">
                    <h4>3 cours :</h4>
                    <p>Le lundi de 20h00 à 21h</p>
                    <p>Le mardi de 11h30 à 12h30</p>
                    <p>Le mardi de 20h à 21h</p>
                </div>
                <div class="box-right">
                    <h4>coachés par :</h4>
                    <p>Léa Huchet</p>
                    <p>Evelyne Bertrand</p>
                    <p> </p>
                </div>
            </div>
            <p class="activity-txt">Renforcement musculaire (abdos, fessiers...) enchaînements dansés pour certains
                cours, coordination, étirements. <br> Permet de travailler efficacement le corps.</p>
        @elseif ($index == 3)
            <h1 class="activity-ttl">Cours de pilates</h1>
            <p class="activity-txt">Amélioration de la souplesse et de la coordination, harmonie du corps et de
                l'esprit, détente et relaxation.</p>
            <img class="activity-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="activity-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="box-content">
                <div class="box-left">
                    <h4>4 cours :</h4>
                    <p>Le mardi de 12h30 à 13h30</p>
                    <p>Le mercredi de 20h à 21h</p>
                    <p>Le jeudi de 15h à 16h</p>
                    <p>Le jeudi de 20h à 21h</p>
                </div>
                <div class="box-right">
                    <h4>coachés par :</h4>
                    <p>Delphine Vattier</p>
                    <p>Nathalie Bon</p>
                    <p>Maud Lemoine</p>
                    <p>Julie Noblet</p>
                </div>
            </div>
            <p class="activity-txt">Méthode de remise en forme globale basée sur des excercices doux aynat pour objectif
                de renforcer les muscles profons essentiels à une bonne posture.</p>
            <p class="activity-txt">Cours visant à muscler harmonieusement toutes les parties du corps, avec une mention
                spéciale pour les abdominaux qui sont travaillés en profondeur.</p>
        @elseif ($index == 4)
            <h1 class="activity-ttl">Cours de stretching</h1>
            <p class="activity-txt">Diminuer le stress et favoriser la relaxation</p>
            <img class="activity-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
            <p class="activity-txt">Au centre sportif de la haie-Vigné.</p>
            <div class="box-content">
                <div class="box-left">
                    <h4>1 cours :</h4>
                    <p>Le lundi de 20h à 21h</p>
                </div>
                <div class="box-right">
                    <h4>coaché par :</h4>
                    <p>Maud Lemoine</p>
                </div>
            </div>
            <p class="activity-txt">Le stretching permet d'étirer les différents muscles ou groupes musculaires du corps
                et d'assouplir les articulations. De ce fait, il préserve contre les traumatismes musculaires et
                articulaires.</p>
        @endif
    </section>
@endforeach --}}



{{-- @php
    $images = $sliderImages ?? collect();
    if ($images->isEmpty()) {
        $images = App\Models\SliderImage::all()->map(function ($image) {
            $image->full_path = 'data:image/png;base64,' . base64_encode($image->image_data);
            return $image;
        });
    }
@endphp --}}
@php
    $activities = App\Models\Activity::all();
@endphp

@foreach ($activities as $index => $activity)
    <section id="activity-box-{{ $index + 1 }}" class="activity-box">
        <h1 class="activity-ttl">{{ $activity->title }}</h1>
        <p class="activity-txt">{{ $activity->description }}</p>
        <img class="activity-img"
             src="data:image/png;base64,{{ base64_encode($activity->image->image_data) }}"
             alt="{{ $activity->image->alt_text }}">
        <p class="activity-txt">{{ $activity->location }}</p>
        <div class="box-content">
            <div class="box-left">
                <h4>Horaire :</h4>
                <p>{{ $activity->schedule }}</p>
                <!-- Ajout de deux lignes de texte supplémentaires -->

            </div>
            <div class="box-right">
                <h4>coaché par :</h4>
                <p>{{ $activity->coach }}</p>
            </div>
        </div>
            <p class="activity-txt">{{ $activity->additional_line1 }}</p>
            <p class="activity-txt">{{ $activity->additional_line2 }}</p>

    </section>
@endforeach



@include('components.footer')
