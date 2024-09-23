document.addEventListener("DOMContentLoaded", function () {
    let slides = document.querySelectorAll(".slider-container");
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
      slides[currentSlide].classList.remove("active");
      currentSlide = (index + slides.length) % slides.length;
      slides[currentSlide].classList.add("active");
    }

    function startAutoSlide() {
      slideInterval = setInterval(() => {
        showSlide(currentSlide + 1);
      }, 5000);
    }

    function stopAutoSlide() {
      clearInterval(slideInterval);
    }

    function setupSlideControls() {
      slides.forEach((slide, index) => {
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
    }

    showSlide(0);
    startAutoSlide();
    setupSlideControls();
  });
