<section class="actuality-slider">
    <h2 class="planning-ttl">Notre actualité</h2>
    @if(isset($sliderImages2))
        @foreach($sliderImages2 as $image)
            <div class="slider-container">
                <img class="slider-image" src="{{ asset($image->image_path) }}" alt="{{ $image->alt_text }}">
                <button class="slide-left-arrow"><</button>
                <button class="slide-btn">En savoir plus</button>
                <button class="slide-right-arrow">></button>
            </div>
        @endforeach
    @endif
</section>
