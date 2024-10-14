

/**
 * Initializes a slider with the given selector, initial slide index, and auto-slide interval.
 * @param {string} selector - The CSS selector for the slides.
 * @param {number} initialSlide - The index of the initial slide.
 * @param {number} autoSlideInterval - The interval for automatic sliding (in milliseconds).
 */
function initializeSlider(selector, initialSlide, autoSlideInterval) {
    const slides = document.querySelectorAll(selector);

    // Check if any slides were found
    if (slides.length === 0) {
        console.error("No slides found with selector:", selector);
        return;
    }

    let currentSlide = initialSlide;
    let slideInterval;

    /**
     * Displays the slide at the given index.
     * @param {number} index - The index of the slide to display.
     */
    function showSlide(index) {
        // Ensure that the index is within bounds before accessing the element
        if (slides[currentSlide]) {
            slides[currentSlide].classList.remove("active");
            slides[currentSlide].style.display = "none"; // Hide previous slide
        }

        // Calculate the next slide index safely
        currentSlide = (index + slides.length) % slides.length;

        // Now apply the changes to the new current slide
        if (slides[currentSlide]) {
            slides[currentSlide].classList.add("active");
            slides[currentSlide].style.display = "block"; // Show current slide
        }
    }

    /**
     * Starts the automatic sliding of the slides.
     */
    function startAutoSlide() {
        if (autoSlideInterval) {
            slideInterval = setInterval(() => {
                showSlide(currentSlide + 1);
            }, autoSlideInterval);
        }
    }

    /**
     * Stops the automatic sliding of the slides.
     */
    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    /**
     * Sets up the event listeners for the slide controls.
     */
    function setupSlideControls() {
        // Activity slider controls
        const activitySlides = document.querySelectorAll(".slide-container");
        activitySlides.forEach((slide, index) => {
            const leftArrow = slide.querySelector(".slide-left-arrow");
            const rightArrow = slide.querySelector(".slide-right-arrow");

            leftArrow.addEventListener("click", (e) => {
                e.preventDefault();
                stopAutoSlide();
                showSlide(currentSlide - 1);
            });

            rightArrow.addEventListener("click", (e) => {
                e.preventDefault();
                stopAutoSlide();
                showSlide(currentSlide + 1);
            });
        });

        // Actuality slider controls
        const actualitySlides = document.querySelectorAll(
            ".actuality-slide-container"
        );
        actualitySlides.forEach((slide, index) => {
            const leftArrow = slide.querySelector(
                ".actuality-slider-left-arrow"
            );
            const rightArrow = slide.querySelector(
                ".actuality-slider-right-arrow"
            );

            leftArrow.addEventListener("click", (e) => {
                e.preventDefault();
                stopAutoSlide();
                showSlide(currentSlide - 1);
            });

            rightArrow.addEventListener("click", (e) => {
                e.preventDefault();
                stopAutoSlide();
                showSlide(currentSlide + 1);
            });
        });
    }function showContent(img) {
        const contentId = img.getAttribute('data-content-id');
        const contentElement = document.getElementById(contentId);

        if (!contentElement) {
            console.error(`Content element with ID '${contentId}' not found`);
            return;
        }

        const content = contentElement.innerHTML;
        const activityContent = document.getElementById('activity-content');

        const title = activityContent.querySelector('.activity-ttl-lg');
        activityContent.innerHTML = '';
        if (title) {
            activityContent.appendChild(title);
        }

        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = content;
        activityContent.appendChild(tempDiv);
    }

    showSlide(initialSlide);
    startAutoSlide();
    setupSlideControls();
}

// Initialize content display for activities
document.addEventListener("DOMContentLoaded", function () {
    const firstImg = document.querySelector(".activity-lg-img");
    if (firstImg) showContent(firstImg);
});

// Initialize Activity Slider
document.addEventListener("DOMContentLoaded", function () {
    initializeSlider(".slide-container", 0, 5000);
});

// Initialize Actuality Slider
document.addEventListener("DOMContentLoaded", function () {
    initializeSlider(".actuality-slide-container", 0, 5000);
});


