
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
function showContent(img) {
    const contentId = img.getAttribute('data-content');
    const content = document.querySelector(contentId).innerHTML;
    document.getElementById('activity-content').innerHTML = content;
}

