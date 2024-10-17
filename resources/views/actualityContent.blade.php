@include('components.header')

@vite(['resources/js/burger.js'])


@php
    $actualities = App\Models\Actuality::with('image')
        ->join('slider_images_2', 'actualities.image_id', '=', 'slider_images_2.id')
        ->orderBy('slider_images_2.id', 'asc')
        ->get(['actualities.*']);
@endphp

@foreach ($actualities as $index => $actuality)
    <section id="actuality-box-{{ $index + 1 }}" class="actuality-box actuality-box-lg" role="region" aria-labelledby="actuality-title-{{ $index + 1 }}">
        <h1 id="actuality-title-{{ $index + 1 }}" class="actuality-ttl">{{ $actuality->title }}</h1>
        <p class="actuality-txt" aria-label="Description de l'actualité">{{ $actuality->description }}</p>
        <img class="actuality-img actuality-img-lg" src="data:image/png;base64,{{ base64_encode($actuality->image->image_data) }}"
            alt="{{ $actuality->image->alt_text }}">
        <p class="actuality-txt" aria-label="Lieu de l'actualité">{{ $actuality->location }}</p>
        <p class="actuality-txt" aria-label="Informations complémentaires 1">{{ $actuality->additional_info_1 }}</p>
        <p class="actuality-txt" aria-label="Informations complémentaires 2">{{ $actuality->additional_info_2 }}</p>
    </section>
@endforeach

@include('components.footer')
