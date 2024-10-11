<h3 class="dash-subttl">Utilisateurs inscrits au cours : {{ $course }}</h3>
<a href="{{ route('export.users.by.course', ['course' => $course]) }}">
    <button class="export-btn">Exporter en CSV</button>
</a>
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
