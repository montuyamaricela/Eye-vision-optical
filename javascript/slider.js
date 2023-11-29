document.addEventListener("DOMContentLoaded", function () {
  const wrapper = document.querySelector(".swiper-wrapper");
  const slides = document.querySelectorAll(".swiper-slide");
  const dotsContainer = document.querySelector(".swiper-dots");
  const dots = [];

  let currentIndex = 0;

  // Function to update the slider
  function updateSlider() {
    slides.forEach((slide, index) => {
      if (index === currentIndex) {
        slide.classList.add("active");
        dots[index].classList.add("active");
      } else {
        slide.classList.remove("active");
        dots[index].classList.remove("active");
      }
    });

    const translateValue = currentIndex * -100;
    wrapper.style.transform = `translateX(${translateValue}%)`;
  }

  // Create dots
  slides.forEach((slide, index) => {
    const dot = document.createElement("div");
    dot.classList.add("swiper-dot");
    dotsContainer.appendChild(dot);
    dots.push(dot);

    dot.addEventListener("click", () => {
      currentIndex = index;
      updateSlider();
    });
  });

  // Automatic slide change
  function autoSlide() {
    currentIndex = (currentIndex + 1) % slides.length;
    updateSlider();
  }

  // Start the interval for automatic slide change (e.g., every 3 seconds)
  interval = setInterval(autoSlide, 5000);

  // Initial call to set the initial position
  updateSlider();
});

const slider = document.querySelector(".slider");
const prevSlideBtn = document.querySelector(".prev-slide");
const nextSlideBtn = document.querySelector(".next-slide");
const slideWidth = 33.33; // Each testimonial occupies 33.33% of the slide width
let slideIndex = 0;

prevSlideBtn.addEventListener("click", () => {
  slideIndex =
    (slideIndex - 1 + slider.children.length) % slider.children.length;
  updateSlides();
});

nextSlideBtn.addEventListener("click", () => {
  slideIndex = (slideIndex + 1) % slider.children.length;
  if (slideIndex === slider.children.length - 2) {
    slideIndex = 0;
  }
  updateSlides();
});

function updateSlides() {
  const translateX = -slideIndex * slideWidth;
  slider.style.transform = `translateX(${translateX}%)`;
}

function autoSlide() {
  slideIndex = (slideIndex + 1) % slider.children.length;
  if (slideIndex === slider.children.length - 2) {
    slideIndex = 0;
  }
  updateSlides();
}

interval = setInterval(autoSlide, 5000);

updateSlides(); // Initialize the slider
