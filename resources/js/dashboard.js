document.querySelector('form[action*="delete-selected-users"]').addEventListener('submit', function(e) {
    const checkboxes = document.querySelectorAll('input[id="user-check"]:checked');
    const messageContainer = document.getElementById('message-container');

    if (checkboxes.length === 0) {
        e.preventDefault();
        messageContainer.innerHTML = '<div class="alert alert-warning">Veuillez sélectionner au moins un utilisateur à supprimer.</div>';
        messageContainer.scrollIntoView({ behavior: 'smooth' });
    } else {
        const confirmDelete = confirm('Êtes-vous sûr de vouloir supprimer les utilisateurs sélectionnés ?');
        if (!confirmDelete) {
            e.preventDefault();
        }
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form[action*="delete-selected-forms"]');
    const messageContainer = document.getElementById('message-container');

    if (form) {
        form.addEventListener('submit', function(e) {
            const checkboxes = document.querySelectorAll('input[id="form-check"]:checked');
            if (checkboxes.length === 0) {
                e.preventDefault();
                messageContainer.innerHTML = '<div class="alert alert-warning">Veuillez sélectionner au moins un formulaire à supprimer.</div>';
                messageContainer.scrollIntoView({ behavior: 'smooth' });
            } else {
                if (!confirm('Êtes-vous sûr de vouloir supprimer les formulaires sélectionnés ?')) {
                    e.preventDefault();
                }
            }
        });
    }
});
document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.toggle-details');
    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const formId = this.getAttribute('data-form-id');
            const detailsRow = document.getElementById(`form-details-${formId}`);
            detailsRow.style.display = detailsRow.style.display === 'none' ? 'table-row' : 'none';
            this.textContent = detailsRow.style.display === 'none' ? 'Détails' : 'Masquer';
        });
    });
});
document.querySelectorAll('.image-select').forEach(select => {
    select.addEventListener('change', function() {
        const textarea = this.closest('.activity-edit-form').querySelector('textarea');
        const selectedImage = this.options[this.selectedIndex].text;
        const content = textarea.value;
        const updatedContent = content.replace(
            /(src=").*?(")/,
            '$1{{ $image->full_path }}$2'
        ).replace(
            /(alt=").*?(")/,
            `$1${selectedImage}$2`
        );
        textarea.value = updatedContent;
    });
});
