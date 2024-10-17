@include('components.header')


@vite(['resources/js/burger.js'])

@php
    $activities = App\Models\Activity::with('image')
        ->join('slider_images', 'activities.image_id', '=', 'slider_images.id')
        ->orderBy('slider_images.id', 'asc')
        ->get(['activities.*']);
@endphp

@foreach ($activities as $index => $activity)
    <section id="activity-box-{{ $index + 1 }}" class="activity-box activity-box-lg" role="region" aria-labelledby="activity-title-{{ $index + 1 }}">
        <h1 id="activity-title-{{ $index + 1 }}" class="activity-ttl">{{ $activity->title }}</h1>
        <p class="activity-txt" aria-label="Description de l'activité">{{ $activity->description }}</p>
        <img class="activity-img activity-img-lg" src="data:image/png;base64,{{ base64_encode($activity->image->image_data) }}"
            alt="{{ $activity->image->alt_text }}">
        <p class="activity-txt" aria-label="Lieu de l'activité">{{ $activity->location }}</p>

        <div class="box-content" role="list">
            <ul class="box-left" aria-label="Horaires de l'activité">
                <li><h4>Horaire :</h4></li>
                <li class="box-left-content">
                    @foreach(explode("\n", $activity->schedule) as $schedule_line)
                        <p>{{ trim($schedule_line) }}</p>
                    @endforeach
                </li>
            </ul>
            <ul class="box-right" aria-label="Coachs de l'activité">
                <li><h4>coaché par :</h4></li>
                <li class="box-right-content">
                    @foreach(explode("\n", $activity->coach) as $coach_line)
                        <p>{{ trim($coach_line) }}</p>
                    @endforeach
                </li>
            </ul>
        </div>

        <p class="activity-txt" aria-label="Informations complémentaires 1">{{ $activity->additional_line1 }}</p>
        <p class="activity-txt" aria-label="Informations complémentaires 2">{{ $activity->additional_line2 }}</p>
    </section>
@endforeach

@include('components.footer')
