// document.addEventListener('DOMContentLoaded', function() {
//     const form = document.querySelector('form.form-container');
//     if (!form) return;

//     form.addEventListener('submit', function(event) {
//         let isValid = true;

//         // Vérifier les champs requis
//         form.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(input) {
//             if (!input.value.trim()) {
//                 isValid = false;
//                 input.classList.add('is-invalid');
//             } else {
//                 input.classList.remove('is-invalid');
//             }
//         });

//         // Vérifier l'email
//         const emailInput = form.querySelector('#email');
//         if (emailInput && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailInput.value)) {
//             isValid = false;
//             emailInput.classList.add('is-invalid');
//         }

//         // Vérifier le mot de passe (si présent)
//         const passwordInput = form.querySelector('#password');
//         const passwordConfirmInput = form.querySelector('#password_confirmation');
//         if (passwordInput && passwordConfirmInput) {
//             if (passwordInput.value.length < 8) {
//                 isValid = false;
//                 passwordInput.classList.add('is-invalid');
//             }
//             if (passwordInput.value !== passwordConfirmInput.value) {
//                 isValid = false;
//                 passwordConfirmInput.classList.add('is-invalid');
//             }
//         }

//         // Vérifier les questions de santé
//         const healthQuestions = form.querySelectorAll('input[name^="health_questions[question"]');
//         let allQuestionsAnswered = true;
//         healthQuestions.forEach(function(question) {
//             if (!question.checked) {
//                 allQuestionsAnswered = false;
//             }
//         });
//         if (!allQuestionsAnswered) {
//             isValid = false;
//             // Ajouter une classe d'erreur à la section des questions de santé
//             const healthSection = form.querySelector('.health-questions');
//             if (healthSection) {
//                 healthSection.classList.add('is-invalid');
//             }
//         }

//         if (!isValid) {
//             event.preventDefault();
//             alert('Veuillez corriger les erreurs dans le formulaire avant de soumettre.');
//         }
//     });
// });
