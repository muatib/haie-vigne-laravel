<section class="actuality-slider">
    <h2 class="planning-ttl">Notre actualité</h2>
    @if ($sliderImages2->isEmpty())
        <p>Aucune image d'actualité n'est disponible.</p>
    @else
        @foreach ($sliderImages2 as $index => $image)
            <div class="actuality-slide-container ">
                <img class="slider-image" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
                <button class="actuality-slider-left-arrow slide-left-arrow"><</button>
                <a href="{{ url('actualityContent#actuality-box-' . ($index + 1)) }}">
                    <button class="slider-btn">En savoir plus</button>
                </a>
                <button class="actuality-slider-right-arrow slide-right-arrow">></button>
            </div>
        @endforeach
    @endif
</section>


<section class="actuality-lg">
    <div class="actuality-lg-left">
        <h1 class="actuality-ttl-lg">Notre actualité</h1>
    </div>
    <div class="actuality-lg-right">
        @foreach ($sliderImages2 as $image)
            <img class="actuality-lg-img" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
        @endforeach
    </div>
</section>
