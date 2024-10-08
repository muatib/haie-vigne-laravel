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
