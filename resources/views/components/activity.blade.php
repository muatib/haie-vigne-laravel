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
    <div class="activity-lg-left" id="activity-content">
        <h1 class="activity-ttl-lg">Nos cours</h1>
        <!-- Le contenu de l'activité sera injecté ici -->
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

<!-- Contenu caché des activités -->
<div style="display: none;">
    @include('activityContent')
</div>
<script>
    function showContent(img) {
        const contentId = img.getAttribute('data-content-id');
        const content = document.getElementById(contentId).innerHTML;
        const activityContent = document.getElementById('activity-content');

        // Garder le titre "Nos cours"
        const title = activityContent.querySelector('.activity-ttl-lg');
        activityContent.innerHTML = '';
        activityContent.appendChild(title);

        // Ajouter le nouveau contenu
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;
        activityContent.appendChild(tempDiv);
    }

    // Afficher le contenu de la première activité au chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        const firstImg = document.querySelector('.activity-lg-img');
        if (firstImg) showContent(firstImg);
    });
    </script>
