@include('components.header')
@php
    use Carbon\Carbon;
    $nonce = App\Services\NonceGenerator::generate();
@endphp
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning">
        {{ session('warning') }}
    </div>
@endif
<h1 class="dash-ttl">Panneau administration</h1>
<div class="table-container">
    <h2 class="dash-subttl">Comptes ({{ $users->count() }})</h2>
    @if ($users->count() > 0)
        <div id="message-container"></div>
        <form action="{{ route('delete.selected.users') }}" method="POST">
            @csrf
            <input type="hidden" name="nonce" value="{{ $nonce }}">
            <button type="submit" class="btn btn-danger mb-3">Supprimer les utilisateurs sélectionnés</button>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        @foreach ($users->first()->getAttributes() as $key => $value)
                            @if (!in_array($key, ['id', 'user_id', 'password', 'remember_token', 'updated_at', 'is_admin']))
                                <th class="{{ $key === 'created_at' ? 'medium-column' : '' }}">
                                    {{ __('tables.' . $key) }}
                                </th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>
                                <input id="user-check" type="checkbox" name="selected_users[]"
                                    value="{{ $user->id }}">
                            </td>
                            @foreach ($user->getAttributes() as $key => $value)
                                @if (!in_array($key, ['id', 'user_id', 'password', 'remember_token', 'updated_at', 'is_admin']))
                                    <td class="{{ $key === 'created_at' ? 'medium-column' : '' }}">
                                        {{ $value ?: 'N/A' }}
                                    </td>
                                @endif
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    @else
        <p>Aucun utilisateur trouvé.</p>
    @endif
</div>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">


<div class="table-container">
    <h2 class="dash-subttl">Formulaires inscription ({{ $forms->count() }})</h2>
    <div id="message-container"></div>
    @if ($forms->count() > 0)
        <form action="{{ route('delete.selected.forms') }}" method="POST">
            @csrf
            <input type="hidden" name="nonce" value="{{ $nonce }}">
            <button type="submit" class="btn btn-danger mb-3">Supprimer les formulaires sélectionnés</button>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Informations</th>
                        <th>Validitée inscription</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($forms as $form)
                        <tr>
                            <td>
                                <input type="checkbox" id="form-check" name="selected_forms[]"
                                    value="{{ $form->id }}">
                            </td>
                            <td>{{ $form->last_name ?? 'N/A' }}</td>
                            <td>{{ $form->first_name ?? 'N/A' }}</td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm toggle-details"
                                    data-form-id="{{ $form->id }}">Détails</button>
                            </td>
                            <td>
                                @if ($form->needs_medical_certificate)
                                    <span class="badge bg-warning text-dark">En attente du certificat médical</span>
                                    <br>
                                    <small>
                                        Date limite :
                                        @if ($form->medical_certificate_deadline)
                                            {{ \Carbon\Carbon::parse($form->medical_certificate_deadline)->format('d/m/Y') }}
                                        @else
                                            N/A
                                        @endif
                                    </small>
                                @else
                                    <span class="badge bg-success">Inscription complète</span>
                                @endif
                                <br>
                                @php
                                    $expirationDate = Carbon::now()->endOfYear()->addYear()->month(6)->day(30);
                                    $monthsRemaining = floor(abs($expirationDate->diffInMonths($form->created_at)));
                                    $currentDate = Carbon::now();
                                @endphp
                                @if ($currentDate >= $expirationDate)
                                    <span class="exp-txt">Expiré.</span>
                                @else
                                    <span class="rem-txt">{{ $monthsRemaining }} mois avant expiration.</span>
                                @endif

                            </td>
                        </tr>
                        <tr class="form-details" id="form-details-{{ $form->id }}" style="display: none;">
                            <td colspan="5">
                                <strong>E-mail:</strong> {{ $form->email ?? 'N/A' }}<br>
                                <strong>Adresse:</strong> {{ $form->address ?? 'N/A' }}<br>
                                <strong>Téléphone:</strong> {{ $form->phone ?? 'N/A' }}<br>
                                <strong>Date de création:</strong> {{ $form->created_at ?? 'N/A' }}<br>
                                <strong>Total:</strong> {{ $form->total ?? 'N/A' }}<br>
                                <strong>Méthode de paiement:</strong> {{ $form->payment_method ?? 'N/A' }}<br>
                                <strong>Cours:</strong>
                                @if (is_string($form->courses))
                                    {{ $form->courses }}
                                @elseif(is_array($form->courses))
                                    {{ implode(', ', $form->courses) }}
                                @else
                                    N/A
                                @endif
                                <br>
                                @for ($i = 1; $i <= 9; $i++)
                                    <strong>Question {{ $i }}:</strong>
                                    {{ $form->{"question$i"} ?? 'N/A' }}<br>
                                @endfor
                                <strong>Fichier joint:</strong>
                                @if ($form->file_upload)
                                    <a href="{{ route('download.file', $form->id) }}"
                                        class="btn btn-sm btn-primary">Télécharger</a>
                                @else
                                    N/A
                                @endif
                                <strong>Statut de l'inscription:</strong>
                                @if ($form->needs_medical_certificate)
                                    En attente du certificat médical
                                    (Date limite :
                                    @if ($form->medical_certificate_deadline)
                                        @if (is_string($form->medical_certificate_deadline))
                                            {{ \Carbon\Carbon::parse($form->medical_certificate_deadline)->format('d/m/Y') }}
                                        @else
                                            {{ $form->medical_certificate_deadline->format('d/m/Y') }}
                                        @endif
                                    @else
                                        N/A
                                    @endif
                                    )
                                @else
                                    Inscription complète
                                @endif
                                <br>
                                <strong>Statut:</strong> {{ $form->registration_status }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </form>
    @else
        <p>Aucun formulaire trouvé.</p>
    @endif
</div>

<img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">

<div class="table-container courses-user">
    <h2 class="dash-subttl">Adhérents par cours</h2>
    @if (empty(request('course')))
        <p class="no-course-txt">Veuillez sélectionner un cours pour filtrer les utilisateurs.</p>
    @endif
    <form id="filter-form" action="{{ route('filter.users.by.course') }}" method="GET">
        <select name="course" id="course-select" class="course-select">
            <option value="">Sélectionner un cours</option>
            <option value="lundi_12h30">Lundi 12h30</option>
            <option value="lundi_20h00">Lundi 20h00</option>
            <option value="mardi_10h30">Mardi 10h30</option>
            <option value="mardi_11h30">Mardi 11h30</option>
            <option value="mardi_12h30">Mardi 12h30</option>
            <option value="mardi_20h00">Mardi 20h00</option>
            <option value="mercredi_20h00">Mercredi 20h00</option>
            <option value="jeudi_15h00">Jeudi 15h00</option>
            <option value="jeudi_20h00">Jeudi 20h00</option>
        </select>
        <button type="submit" class="filter-btn">Filtrer</button>
    </form>

    <div id="filtered-users-container">
        @isset($filteredUsers)
            <h3 class="dash-subttl">Utilisateurs inscrits au cours : {{ request('course') }}</h3>
            <a href="{{ route('export.users.by.course', ['course' => request('course')]) }}"><button
                    class="export-btn">Exporter en CSV</button></a>>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Téléphone</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($filteredUsers as $user)
                        <tr>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->firstname }}</td>
                            <td>{{ $user->form->phone ?? 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            @endif
        </div>
    </div>

    <img class="separation" src="{{ asset('asset/img/separation.png') }}" alt="separation">





    <div class="forms-container">
        <div class="content-forms">
            <div class="form-column">
                <div class="table-container activities-form">
                    <h2 class="dash-subttl">Éditer les activités</h2>

                    <p>Test d'affichage du formulaire des activités</p>

                    @if (isset($images))
                        <p>La variable $images est définie.</p>
                        @if ($images->count() > 0)
                            <p>Il y a {{ $images->count() }} images.</p>
                            <form action="{{ route('update.activities') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nonce" value="{{ $nonce }}">
                                @foreach ($images as $index => $image)
                                    <div class="activity-section activity-edit-form">
                                        <h3>Activité {{ $index + 1 }}</h3>
                                        <input type="hidden" name="activities[{{ $index }}][id]"
                                            value="{{ $image->id }}">
                                        <div class="form-group">
                                            <input type="text" name="activities[{{ $index }}][title]"
                                                class="form-control"
                                                value="{{ $image->title ?? old('activities.' . $index . '.title') }}"
                                                placeholder="Titre de l'activité">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="activities[{{ $index }}][description]" class="form-control"
                                                placeholder="Description de l'activité">{{ $image->description ?? old('activities.' . $index . '.description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="activities[{{ $index }}][location]"
                                                class="form-control"
                                                value="{{ $image->location ?? old('activities.' . $index . '.location') }}"
                                                placeholder="Lieu">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="activities[{{ $index }}][schedule]" class="form-control" rows="4"
                                                placeholder="Horaire">{{ $image->schedule ?? old('activities.' . $index . '.schedule') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <textarea name="activities[{{ $index }}][coach]" class="form-control" rows="4" placeholder="Coach">{{ $image->coach ?? old('activities.' . $index . '.coach') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                name="activities[{{ $index }}][additional_line1]"
                                                class="form-control"
                                                value="{{ $image->additional_line1 ?? old('activities.' . $index . '.additional_line1') }}"
                                                placeholder="Ligne supplémentaire 1">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                name="activities[{{ $index }}][additional_line2]"
                                                class="form-control"
                                                value="{{ $image->additional_line2 ?? old('activities.' . $index . '.additional_line2') }}"
                                                placeholder="Ligne supplémentaire 2">
                                        </div>
                                        @if (isset($image->image) && $image->image->image_data)
                                            <img src="data:image/png;base64,{{ base64_encode($image->image->image_data) }}"
                                                alt="{{ $image->image->alt_text ?? 'Image de l\'activité' }}"
                                                class="activity-image">
                                        @else
                                            <p>Aucune image disponible pour cette activité</p>
                                        @endif
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary mt-3 btn-update">Mettre à jour les
                                    activités</button>
                            </form>
                        @else
                            <p>La collection $images est vide.</p>
                        @endif
                    @else
                        <p>La variable $images n'est pas définie.</p>
                    @endif
                </div>
            </div>

            <div class="form-column">
                <div class="table-container actualities-form">
                    <h2 class="dash-subttl">Éditer les actualités</h2>

                    @if (isset($actualities))
                        @if ($actualities->count() > 0)
                            <p>Il y a {{ $actualities->count() }} actualités.</p>
                            <form action="{{ route('update.actualities') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nonce" value="{{ $nonce }}">
                                @foreach ($actualities as $index => $actuality)
                                    <div class="actuality-section actuality-edit-form">
                                        <h3>Actualité {{ $index + 1 }}</h3>
                                        <input type="hidden" name="actualities[{{ $index }}][id]"
                                            value="{{ $actuality->id }}">
                                        <div class="form-group">
                                            <input type="text" name="actualities[{{ $index }}][title]"
                                                class="form-control"
                                                value="{{ $actuality->title ?? old('actualities.' . $index . '.title') }}"
                                                placeholder="Titre de l'actualité">
                                        </div>
                                        <div class="form-group">
                                            <textarea name="actualities[{{ $index }}][description]" class="form-control"
                                                placeholder="Description de l'actualité">{{ $actuality->description ?? old('actualities.' . $index . '.description') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" name="actualities[{{ $index }}][location]"
                                                class="form-control"
                                                value="{{ $actuality->location ?? old('actualities.' . $index . '.location') }}"
                                                placeholder="Lieu">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                name="actualities[{{ $index }}][additional_info_1]"
                                                class="form-control"
                                                value="{{ $actuality->additional_info_1 ?? old('actualities.' . $index . '.additional_info_1') }}"
                                                placeholder="Information supplémentaire 1">
                                        </div>
                                        <div class="form-group">
                                            <input type="text"
                                                name="actualities[{{ $index }}][additional_info_2]"
                                                class="form-control"
                                                value="{{ $actuality->additional_info_2 ?? old('actualities.' . $index . '.additional_info_2') }}"
                                                placeholder="Information supplémentaire 2">
                                        </div>
                                        <img src="data:image/png;base64,{{ base64_encode($actuality->image->image_data) }}"
                                            alt="{{ $actuality->image->alt_text }}" class="actuality-image">
                                    </div>
                                @endforeach
                                <button type="submit" class="btn btn-primary mt-3 btn-update">Mettre à jour les
                                    actualités</button>
                            </form>
                        @else
                            <p>Aucune actualité n'est disponible.</p>
                        @endif
                    @else
                        <p>La variable $actualities n'est pas définie.</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="image-forms">
            <div class="form-column">
                <div class="slider-image-form">
                    <h2 class="dash-subttl">Modifier les images des activités</h2>
                    <form action="{{ route('update.slider.images') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nonce" value="{{ $nonce }}">
                        @method('POST')
                        @php
                            $sliderImages = App\Models\SliderImage::all();
                        @endphp
                        <div class="image-mosaic">
                            @foreach ($sliderImages as $image)
                                <div class="image-item">
                                    <img src="data:image/png;base64,{{ base64_encode($image->image_data) }}"
                                        alt="{{ $image->alt_text }}">
                                    <div class="image-overlay">
                                        <label for="image-{{ $image->id }}" class="file-input-label">Choisir</label>
                                        <input type="file" id="image-{{ $image->id }}"
                                            name="images[{{ $image->id }}]" class="file-input" accept="image/*">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="button-container">
                            <button type="submit" class="submit-button">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="form-column">
                <div class="slider-image-form">
                    <h2 class="dash-subttl">Modifier les images des actualités</h2>
                    <form action="{{ route('update.slider.images2') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="nonce" value="{{ $nonce }}">
                        @method('POST')
                        @php
                            $sliderImages2 = App\Models\SliderImage2::all();
                        @endphp
                        <div class="image-mosaic">
                            @foreach ($sliderImages2 as $image)
                                <div class="image-item">
                                    <img src="data:image/png;base64,{{ base64_encode($image->image_data) }}"
                                        alt="{{ $image->alt_text }}">
                                    <div class="image-overlay">
                                        <label for="image2-{{ $image->id }}" class="file-input-label">Choisir</label>
                                        <input type="file" id="image2-{{ $image->id }}"
                                            name="images2[{{ $image->id }}]" class="file-input" accept="image/*">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="button-container">
                            <button type="submit" class="submit-button">Mettre à jour</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
