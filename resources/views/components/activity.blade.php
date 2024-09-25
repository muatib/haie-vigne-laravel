<section class="activity-slider">
    <h2 class="slider-ttl">Les activités de l'association</h2>
    @foreach ($sliderImages as $image)
        <div class="slide-container">
            <img class="slide-image" src="{{ asset($image->image_path) }}" alt="{{ $image->alt_text }}">

            <button class="slider-left-arrow"><</button>
            <a href="{{ url('activityContent') }}"><button class="slider-btn">En savoir plus</button></a>

            <button class="slider-right-arrow">></button>
        </div>
    @endforeach
</section>
