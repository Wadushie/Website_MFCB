// Carousel Functionality
let currentSlide = 0;
const slides = document.querySelectorAll('.img-container');
const totalSlides = slides.length;

function showSlide(index) {
    if (index >= totalSlides) {
        currentSlide = 0;
    } else if (index < 0) {
        currentSlide = totalSlides - 1;
    } else {
        currentSlide = index;
    }

    const offset = -currentSlide * 100;
    document.querySelector('.slider-images').style.transform = `translateX(${offset}%)`;
}

function nextSlide() {
    showSlide(currentSlide + 1);
}

function prevSlide() {
    showSlide(currentSlide - 1);
}

// Auto-play the carousel
let autoPlayInterval = setInterval(nextSlide, 5000);

// Pause auto-play on hover
const sliderFrame = document.querySelector('.slider-frame');
if (sliderFrame) {
    sliderFrame.addEventListener('mouseenter', () => clearInterval(autoPlayInterval));
    sliderFrame.addEventListener('mouseleave', () => autoPlayInterval = setInterval(nextSlide, 5000));
}

// Add event listeners for manual controls
const prevButton = document.querySelector('.carousel-control.prev');
const nextButton = document.querySelector('.carousel-control.next');

if (prevButton && nextButton) {
    prevButton.addEventListener('click', prevSlide);
    nextButton.addEventListener('click', nextSlide);
}