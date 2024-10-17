@include('components.header')

@vite(['resources/js/burger.js'])


@php
$courseNames = [
    'lundi_20h00' => 'Fitness',
    'mardi_11h30' => 'Fitness',
    'mardi_12h30' => 'Pilates',
    'mardi_20h00' => 'Fitness',
    'mercredi_20h00' => 'Pilates',
    'jeudi_12h20' => 'Yoga',
    'jeudi_14h00' => 'Stretching',
    'jeudi_15h00' => 'Pilates',
    'jeudi_20h00' => 'Pilates',
];
@endphp

<div class="user-account-container" role="region" aria-labelledby="account-title">
    <h1 id="account-title" class="acc-ttl">Mon compte</h1>
    <div class="account-info">
        <p class="acc-txt"><strong>Nom :</strong> {{ Auth::user()->lastname }} {{ Auth::user()->firstname }}</p>
        <p class="acc-txt"><strong>Email :</strong> {{ Auth::user()->email }}</p>

        @if(Auth::user()->form)
            <p class="acc-txt"><strong>Date d'inscription :</strong> {{ Auth::user()->form->created_at->format('d/m/Y') }}</p>
            <p class="acc-txt"><strong>Total cotisation :</strong> {{ Auth::user()->form->total }} €</p>

            <h2 class="acc-subtl" id="selected-courses">Cours choisis</h2>
            <table class="course-table" aria-labelledby="selected-courses">
                <thead>
                    <tr>
                        <th scope="col">Jour</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Type de cours</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach(json_decode(Auth::user()->form->courses) as $course)
                        @php
                            list($day, $time) = explode('_', $course);
                            $courseName = $courseNames[$course] ?? 'Non spécifié';
                        @endphp
                        <tr>
                            <td>{{ ucfirst($day) }}</td>
                            <td>{{ substr($time, 0, 2) . '' . substr($time, 2) }}</td>
                            <td>{{ $courseName }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="acc-txt">Vous n'êtes pas encore inscrit à des cours.</p>
        @endif
    </div>

    <form action="{{ route('logout') }}" method="POST" class="logout-form" aria-label="Formulaire de déconnexion">
        @csrf
        <button class="btn logout-btn " type="submit" aria-label="Se déconnecter">Se déconnecter</button>
    </form>
</div>

@include('components.footer')
