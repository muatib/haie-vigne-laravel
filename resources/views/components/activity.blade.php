<section class="activity-slider">
    <h2 class="slider-ttl">Les activités de l'association</h2>
    @foreach ($sliderImages as $index => $image)
        <div class="slide-container">
            <img class="slide-image" src="{{ asset($image->image_path) }}" alt="{{ $image->alt_text }}">
            <button class="slider-left-arrow"><</button>
                    <a href="{{ url('activityContent#activity-box-' . ($index + 1)) }}"><button class="slider-btn">En
                            savoir plus</button></a>

                    <button class="slider-right-arrow">></button>
        </div>
    @endforeach
</section>

<section class="activity-lg">
    <div class="activity-lg-left">
        <h1 class="activity-ttl-lg">Cours de yoga vygnasa doux</h1>
    </div>
    <div class="activity-lg-right">
        <img class="activity-lg-img" src="{{ asset('asset/img/yoga.png') }}" alt="yoga">
        <img class="activity-lg-img" src="{{ asset('asset/img/pilates.png') }}" alt="pilates">
        <img class="activity-lg-img" src="{{ asset('asset/img/fitness.png') }}" alt="fitness">
        <img class="activity-lg-img" src="{{ asset('asset/img/stretching.png') }}" alt="stretching">
        <img class="activity-lg-img" src="{{ asset('asset/img/gym.png') }}" alt="gym">
    </div>


</section>
