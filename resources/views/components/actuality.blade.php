
@vite(['resources/js/app.js', 'resources/js/sliders.js'])
<section class="actuality-slider">
    <h2 class="planning-ttl"></h2>
    @if ($sliderImages2->isEmpty())
        <p>Aucune image d'actualité n'est disponible.</p>
    @else
        @foreach ($sliderImages2 as $index => $image)
            <div class="actuality-slide-container">
                <img class="actuality-slider-image" src="{{ $image->full_path }}" alt="{{ $image->alt_text }}">
                <button class="actuality-slider-left-arrow slider-left-arrow"><</button>
                <a href="{{ url('actualityContent#actuality-box-' . ($index + 1)) }}">
                    <button class="slider-btn">En savoir plus</button>
                </a>
                <button class="actuality-slider-right-arrow slider-right-arrow">></button>
            </div>
        @endforeach
    @endif
  </section>



<section class="actuality-lg">
    <div class="actuality-lg-left" id="actuality-content">
        <h1 class="actuality-ttl-lg"></h1>

    </div>
    <div class="actuality-lg-right">
        @foreach ($sliderImages2 as $index => $image)
            <img class="actuality-lg-img"
                 src="{{ $image->full_path }}"
                 alt="{{ $image->alt_text }}"
                 data-content-id="actuality-box-{{ $index + 1 }}"
                 onclick="showActualityContent(this)">
        @endforeach
    </div>
</section>


<div style="display: none;">
    @include('actualityContent')
</div>

<script>
// Function for Actuality content
function showActualityContent(img) {
    const contentId = img.getAttribute('data-content-id');
    const content = document.getElementById(contentId).innerHTML;
    const actualityContent = document.getElementById('actuality-content');

    // Update content
    const title = actualityContent.querySelector('.actuality-ttl-lg');
    actualityContent.innerHTML = '';
    actualityContent.appendChild(title);

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = content;
    actualityContent.appendChild(tempDiv);

    // Remove 'selected' class from all images
    const allImages = document.querySelectorAll('.actuality-lg-img');
    allImages.forEach(image => {
        image.classList.remove('selected');
    });

    // Add 'selected' class to the clicked image
    img.classList.add('selected');
}

// Function for Activity content
function showActivityContent(img) {
    const contentId = img.getAttribute('data-content-id');
    const content = document.getElementById(contentId).innerHTML;
    const activityContent = document.getElementById('activity-content');

    // Update content
    const title = activityContent.querySelector('.activity-ttl-lg');
    activityContent.innerHTML = '';
    activityContent.appendChild(title);

    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = content;
    activityContent.appendChild(tempDiv);

    // Remove 'selected' class from all images
    const allImages = document.querySelectorAll('.activity-lg-img');
    allImages.forEach(image => {
        image.classList.remove('selected');
    });

    // Add 'selected' class to the clicked image
    img.classList.add('selected');
}

document.addEventListener('DOMContentLoaded', function() {
    // Initialize Actuality content
    const firstActualityImg = document.querySelector('.actuality-lg-img');
    if (firstActualityImg) {
        showActualityContent(firstActualityImg);
        firstActualityImg.classList.add('selected');
    }

    // Initialize Activity content
    const firstActivityImg = document.querySelector('.activity-lg-img');
    if (firstActivityImg) {
        showActivityContent(firstActivityImg);
        firstActivityImg.classList.add('selected');
    }

    // Add click event listeners for Actuality images
    document.querySelectorAll('.actuality-lg-img').forEach(img => {
        img.addEventListener('click', () => showActualityContent(img));
    });

    // Add click event listeners for Activity images
    document.querySelectorAll('.activity-lg-img').forEach(img => {
        img.addEventListener('click', () => showActivityContent(img));
    });
});

</script>

