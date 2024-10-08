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
    <div class="actuality-lg-left" id="actuality-content">
        <h1 class="actuality-ttl-lg">Notre actualité</h1>
        <!-- Le contenu de l'actualité sera injecté ici -->
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

<!-- Contenu caché des actualités -->
<div style="display: none;">
    @include('actualityContent')
</div>

<script>
function showActualityContent(img) {
    const contentId = img.getAttribute('data-content-id');
    const content = document.getElementById(contentId).innerHTML;
    const actualityContent = document.getElementById('actuality-content');

    // Garder le titre "Notre actualité"
    const title = actualityContent.querySelector('.actuality-ttl-lg');
    actualityContent.innerHTML = '';
    actualityContent.appendChild(title);

    // Ajouter le nouveau contenu
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = content;
    actualityContent.appendChild(tempDiv);
}

// Afficher le contenu de la première actualité au chargement de la page
document.addEventListener('DOMContentLoaded', function() {
    const firstImg = document.querySelector('.actuality-lg-img');
    if (firstImg) showActualityContent(firstImg);
});
</script>
    </script>
