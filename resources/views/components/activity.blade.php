
@vite(['resources/js/app.js', 'resources/js/sliders.js'])
<section class="activity-slider">
    <h2 class="slider-ttl">Les activités de l'association</h2>
    @if ($sliderImages->isEmpty())
        <p>Aucune image n'est disponible.</p>
    @else
        @foreach ($sliderImages as $index => $image)
            <div class="slide-container">
                <img class="slide-image" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
                <button class="slide-left-arrow"><</button>
                <a href="{{ url('activityContent#activity-box-' . ($index + 1)) }}">
                    <button class="slider-btn">En savoir plus</button>
                </a>
                <button class="slide-right-arrow">></button>
            </div>
        @endforeach
    @endif
</section>


<section class="activity-lg">
    <div class="activity-lg-left" id="activity-content">
        <h1 class="activity-ttl-lg"></h1>
    </div>
    <div class="activity-lg-right">
        @foreach ($sliderImages as $index => $image)
            <img class="activity-lg-img"
                 src="{{ $image->full_path }}"
                 alt="{{ $image->alt_text }}"
                 data-content-id="activity-box-{{ $index + 1 }}"
                 onclick="showContent(this)">
        @endforeach
    </div>
</section>


<div style="display: none;">
    @include('activityContent')
</div>
<script>
    function showContent(img) {
        const contentId = img.getAttribute('data-content-id');
        const content = document.getElementById(contentId).innerHTML;
        const activityContent = document.getElementById('activity-content');


        const title = activityContent.querySelector('.activity-ttl-lg');
        activityContent.innerHTML = '';
        activityContent.appendChild(title);


        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;
        activityContent.appendChild(tempDiv);
    }


    document.addEventListener('DOMContentLoaded', function() {
        const firstImg = document.querySelector('.activity-lg-img');
        if (firstImg) showContent(firstImg);
    });
    </script>


