<section class="activity-slider">
    <h2 class="slider-ttl">Les activités de l'association</h2>
    @if ($sliderImages->isEmpty())
        <p>Aucune image n'est disponible.</p>
    @else
        @foreach ($sliderImages as $index => $image)
            <div class="slide-container ">
                <img class="slide-image" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
                <button class="slider-left-arrow"><</button>
                <a href="{{ url('activityContent#activity-box-' . ($index + 1)) }}">
                    <button class="slider-btn">En savoir plus</button>
                </a>
                <button class="slider-right-arrow">></button>
            </div>
        @endforeach
    @endif
</section>


<section class="activity-lg">
    <div class="activity-lg-left">
        <h1 class="activity-ttl-lg">Nos cours</h1>
    </div>
    <div class="activity-lg-right">
        @foreach ($sliderImages as $image)
            <img class="activity-lg-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
        @endforeach
    </div>
</section>
