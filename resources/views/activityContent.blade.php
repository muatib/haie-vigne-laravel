@include('components.header')


@php
    $activities = App\Models\Activity::with('image')
        ->join('slider_images', 'activities.image_id', '=', 'slider_images.id')
        ->orderBy('slider_images.id', 'asc')
        ->get(['activities.*']);
@endphp

@foreach ($activities as $index => $activity)
    <section id="activity-box-{{ $index + 1 }}" class="activity-box activity-box-lg">
        <h1 class="activity-ttl">{{ $activity->title }}</h1>
        <p class="activity-txt">{{ $activity->description }}</p>
        <img class="activity-img" src="data:image/png;base64,{{ base64_encode($activity->image->image_data) }}"
            alt="{{ $activity->image->alt_text }}">
        <p class="activity-txt">{{ $activity->location }}</p>
        <div class="box-content">
            <ul class="box-left">
                <li><h4>Horaire :</h4></li>
                <li class="box-left-content">
                    @foreach(explode("\n", $activity->schedule) as $schedule_line)
                        <p>{{ trim($schedule_line) }}</p>
                    @endforeach
                </li>
            </ul>
            <ul class="box-right">
                <li>
                    <h4>coaché par :</h4>
                </li>
                <li class="box-right-content">
                    @foreach(explode("\n", $activity->coach) as $coach_line)
                        <p>{{ trim($coach_line) }}</p>
                    @endforeach
                </li>
            </ul>
        </div>
        <p class="activity-txt">{{ $activity->additional_line1 }}</p>
        <p class="activity-txt">{{ $activity->additional_line2 }}</p>
    </section>
@endforeach




@include('components.footer')
