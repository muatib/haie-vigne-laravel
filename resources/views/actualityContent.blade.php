@include('components.header')




    @php
    $actualities = App\Models\Actuality::with('image')
        ->join('slider_images_2', 'actualities.image_id', '=', 'slider_images_2.id')
        ->orderBy('slider_images_2.id', 'asc')
        ->get(['actualities.*']);
@endphp

@foreach ($actualities as $index => $actuality)
    <section id="actuality-box-{{ $index + 1 }}" class="actuality-box actuality-box-lg">
        <h1 class="actuality-ttl">{{ $actuality->title }}</h1>
        <p class="actuality-txt">{{ $actuality->description }}</p>
        <img class="actuality-img actuality-img-lg" src="data:image/png;base64,{{ base64_encode($actuality->image->image_data) }}"
            alt="{{ $actuality->image->alt_text }}">
        <p class="actuality-txt">{{ $actuality->location }}</p>
        <p class="actuality-txt">{{ $actuality->additional_info_1 }}</p>
        <p class="actuality-txt">{{ $actuality->additional_info_2 }}</p>
    </section>
@endforeach







@include('components.footer')
