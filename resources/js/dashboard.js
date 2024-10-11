/**
 * Handles the deletion of selected users.
 * @param {Event} e - The submit event.
 */
function handleUserDeletion(e) {
    const checkboxes = document.querySelectorAll('input[id="user-check"]:checked');
    const messageContainer = document.getElementById('message-container');

    if (checkboxes.length === 0) {
        e.preventDefault();
        showMessage(messageContainer, 'Veuillez sélectionner au moins un utilisateur à supprimer.', 'warning');
    } else {
        if (!confirm('Êtes-vous sûr de vouloir supprimer les utilisateurs sélectionnés ?')) {
            e.preventDefault();
        }
    }
}

/**
 * Handles the deletion of selected forms.
 * @param {Event} e - The submit event.
 */
function handleFormDeletion(e) {
    const checkboxes = document.querySelectorAll('input[id="form-check"]:checked');
    const messageContainer = document.getElementById('message-container');

    if (checkboxes.length === 0) {
        e.preventDefault();
        showMessage(messageContainer, 'Veuillez sélectionner au moins un formulaire à supprimer.', 'warning');
    } else {
        if (!confirm('Êtes-vous sûr de vouloir supprimer les formulaires sélectionnés ?')) {
            e.preventDefault();
        }
    }
}

/**
 * Displays a message in the specified container.
 * @param {HTMLElement} container - The message container element.
 * @param {string} message - The message to display.
 * @param {string} type - The type of message (e.g., 'warning').
 */
function showMessage(container, message, type) {
    container.innerHTML = `<div class="alert alert-${type}">${message}</div>`;
    container.scrollIntoView({ behavior: 'smooth' });
}

/**
 * Toggles the visibility of form details.
 * @param {Event} e - The click event.
 */
function toggleFormDetails(e) {
    const formId = e.target.getAttribute('data-form-id');
    const detailsRow = document.getElementById(`form-details-${formId}`);
    const isHidden = detailsRow.style.display === 'none';
    detailsRow.style.display = isHidden ? 'table-row' : 'none';
    e.target.textContent = isHidden ? 'Masquer' : 'Détails';
}

/**
 * Updates the textarea content based on the selected image.
 * @param {Event} e - The change event.
 */
function updateImageInTextarea(e) {
    const textarea = e.target.closest('.activity-edit-form').querySelector('textarea');
    const selectedImage = e.target.options[e.target.selectedIndex].text;
    const content = textarea.value;
    const updatedContent = content
        .replace(/(src=").*?(")/,  '$1{{ $image->full_path }}$2')
        .replace(/(alt=").*?(")/,  `$1${selectedImage}$2`);
    textarea.value = updatedContent;
}

// Event listeners
document.addEventListener('DOMContentLoaded', function() {
    // User deletion form
    const userDeletionForm = document.querySelector('form[action*="delete-selected-users"]');
    if (userDeletionForm) {
        userDeletionForm.addEventListener('submit', handleUserDeletion);
    }

    // Form deletion form
    const formDeletionForm = document.querySelector('form[action*="delete-selected-forms"]');
    if (formDeletionForm) {
        formDeletionForm.addEventListener('submit', handleFormDeletion);
    }

    // Toggle details buttons
    const toggleButtons = document.querySelectorAll('.toggle-details');
    toggleButtons.forEach(button => button.addEventListener('click', toggleFormDetails));

    // Image select dropdowns
    const imageSelects = document.querySelectorAll('.image-select');
    imageSelects.forEach(select => select.addEventListener('change', updateImageInTextarea));
});
