@include('components.header')

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
    <h2 class="dash-subttl">Utilisateurs ({{ $users->count() }})</h2>
    @if($users->count() > 0)
    <div id="message-container"></div>
        <form action="{{ route('delete.selected.users') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mb-3">Supprimer les utilisateurs sélectionnés</button>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        @foreach($users->first()->getAttributes() as $key => $value)
                            @if(!in_array($key, ['id', 'user_id', 'password', 'remember_token', 'updated_at', 'is_admin']))
                                <th class="{{ $key === 'created_at' ? 'medium-column' : '' }}">
                                    {{ __('tables.'.$key) }}
                                </th>
                            @endif
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <input id="user-check" type="checkbox" name="selected_users[]" value="{{ $user->id }}">
                            </td>
                            @foreach($user->getAttributes() as $key => $value)
                                @if(!in_array($key, ['id', 'user_id', 'password', 'remember_token', 'updated_at', 'is_admin']))
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

`
<div class="table-container">
    <h2 class="dash-subttl">Formulaires ({{ $forms->count() }})</h2>
    <div id="message-container"></div>
    @if($forms->count() > 0)
        <form action="{{ route('delete.selected.forms') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger mb-3">Supprimer les formulaires sélectionnés</button>
            <table class="custom-table">
                <thead>
                    <tr>
                        <th>Sélectionner</th>
                        <th>Informations</th>
                        <th>Détails</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($forms as $form)
                        <tr>
                            <td>
                                <input type="checkbox" id="form-check" name="selected_forms[]" value="{{ $form->id }}">
                            </td>
                            <td>
                                <strong>Prénom:</strong> {{ $form->first_name ?? 'N/A' }}<br>
                                <strong>Nom:</strong> {{ $form->last_name ?? 'N/A' }}<br>
                                <strong>E-mail:</strong> {{ $form->email ?? 'N/A' }}<br>
                                <strong>Adresse:</strong> {{ $form->address ?? 'N/A' }}<br>
                                <strong>Téléphone:</strong> {{ $form->phone ?? 'N/A' }}<br>
                                <strong>Date de création:</strong> {{ $form->created_at ?? 'N/A' }}<br>
                                <strong>Total:</strong> {{ $form->total ?? 'N/A' }}<br>
                                <strong>Méthode de paiement:</strong> {{ $form->payment_method ?? 'N/A' }}
                            </td>
                            <td>
                                <strong>Cours:</strong> {{ $form->courses ?? 'N/A' }}<br>
                                @for($i = 1; $i <= 9; $i++)
                                    <strong>Question {{ $i }}:</strong> {{ $form->{"question$i"} ?? 'N/A' }}<br>
                                @endfor
                                <strong>Fichier joint:</strong>
                                @if($form->file_upload)
                                    <a href="{{ route('download.file', $form->id) }}" class="btn btn-sm btn-primary">Télécharger</a>
                                @else
                                    N/A
                                @endif
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

