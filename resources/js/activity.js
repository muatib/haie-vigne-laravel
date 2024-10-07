// document.addEventListener("DOMContentLoaded", function () {
//     let slides = document.querySelectorAll(".slide-container");
//     let currentSlide = 0;
//     let slideInterval;

//     function showSlide(index) {
//         slides[currentSlide].style.display = 'none';
//         currentSlide = (index + slides.length) % slides.length;
//         slides[currentSlide].style.display = 'block';
//     }

//     function startAutoSlide() {
//         if (!slideInterval) {
//             slideInterval = setInterval(() => {
//                 showSlide(currentSlide + 1);
//             }, 5000);
//         }
//     }

//     function stopAutoSlide() {
//         clearInterval(slideInterval);
//         slideInterval = null;
//     }

//     function setupSlideControls() {
//         slides.forEach((slide, index) => {
//             const leftArrow = slide.querySelector(".slider-left-arrow");
//             const rightArrow = slide.querySelector(".slider-right-arrow");

//             leftArrow.addEventListener("click", (e) => {
//                 e.preventDefault();
//                 stopAutoSlide();
//                 showSlide(currentSlide - 1);
//             });

//             rightArrow.addEventListener("click", (e) => {
//                 e.preventDefault();
//                 stopAutoSlide();
//                 showSlide(currentSlide + 1);
//             });
//         });
//     }

//     // Cacher toutes les slides sauf la première
//     slides.forEach((slide, index) => {
//         if (index === 0) {
//             slide.style.display = 'block';
//         } else {
//             slide.style.display = 'none';
//         }
//     });

//     showSlide(0);
//     startAutoSlide();
//     setupSlideControls();

// });
let slides2 = document.querySelectorAll(".actuality-slide-container");
let currentSlide2 = 0;
let slideInterval2;

function showSlide2(index) {
    slides2[currentSlide2].style.display = 'none';
    currentSlide2 = (index + slides2.length) % slides2.length;
    slides2[currentSlide2].style.display = 'block';
}

function startAutoSlide2() {
    if (!slideInterval2) {
        slideInterval2 = setInterval(() => {
            showSlide2(currentSlide2 + 1);
        }, 5000);
    }
}

function stopAutoSlide2() {
    clearInterval(slideInterval2);
    slideInterval2 = null;
}

function setupSlideControls2() {
    slides2.forEach((slide, index) => {
        const leftArrow = slide.querySelector(".actuality-slider-left-arrow");
        const rightArrow = slide.querySelector(".actuality-slider-right-arrow");

        leftArrow.addEventListener("click", (e) => {
            e.preventDefault();
            stopAutoSlide2();
            showSlide2(currentSlide2 - 1);
        });

        rightArrow.addEventListener("click", (e) => {
            e.preventDefault();
            stopAutoSlide2();
            showSlide2(currentSlide2 + 1);
        });
    });
}

// Cacher toutes les slides sauf la première
slides2.forEach((slide, index) => {
    if (index === 0) {
        slide.style.display = 'block';
    } else {
        slide.style.display = 'none';
    }
});

showSlide2(0);
startAutoSlide2();
setupSlideControls2();
