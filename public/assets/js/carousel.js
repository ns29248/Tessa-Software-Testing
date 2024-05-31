// Carousel
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;
    const carouselBackground = document.querySelector('.carousel-background');
    const animationClasses = ['animate-up', 'animate-right', 'animate-down', 'animate-left'];
    let currentSlideIndex = 0;
    let lastAnimationIndex = -1;

    function getNextAnimation() {
        lastAnimationIndex = (lastAnimationIndex + 1) % animationClasses.length;
        return animationClasses[lastAnimationIndex];
    }

    function showSlide(index) {
        const currentSlide = slides[currentSlideIndex];
        const nextSlide = slides[index];

        // Update the background with the current slide's image
        carouselBackground.style.backgroundImage = `url('${currentSlide.querySelector('img').src}')`;

        // Reset all slides before showing the next one
        slides.forEach(slide => {
            slide.classList.remove('active', ...animationClasses);
            slide.style.opacity = '0';
        });

        // Add animation and make the next slide active
        nextSlide.classList.add(getNextAnimation());
        nextSlide.classList.add('active');
        nextSlide.style.opacity = '1';

        currentSlideIndex = index;
    }

    function changeSlide(direction) {
        let nextIndex = currentSlideIndex;
        if (direction === 'next') {
            nextIndex = currentSlideIndex < totalSlides - 1 ? currentSlideIndex + 1 : 0;
        } else if (direction === 'prev') {
            nextIndex = currentSlideIndex > 0 ? currentSlideIndex - 1 : totalSlides - 1;
        }
        showSlide(nextIndex);
    }

    // Set up event listeners for carousel controls
    document.querySelector('.carousel-control.prev').addEventListener('click', () => changeSlide('prev'));
    document.querySelector('.carousel-control.next').addEventListener('click', () => changeSlide('next'));

    // Initialize the carousel by showing the first slide
    showSlide(currentSlideIndex);

    // Set interval for automatic slide change every 4 seconds
    setInterval(() => changeSlide('next'), 4000);
});
//Carousel --End--

//BRAND SLIDES
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.brand-slides');
    const slides = Array.from(document.querySelectorAll('.brand-item'));
    const slideWidth = slides[0].clientWidth;  // Width of one slide

    // Define the auto-scroll function
    function autoScroll() {
        slider.scrollBy({ left: slideWidth, behavior: 'smooth' });

        // Check if the first slide is out of view, then move it to the end
        if (slider.scrollLeft >= slideWidth) {
            let firstSlide = slider.removeChild(slides[0]);  // Remove the first slide
            slider.appendChild(firstSlide);  // Append it to the end
            slides.push(firstSlide);  // Add it back to the array at the end
            slides.shift();  // Remove the first element from the array
            slider.scrollLeft -= slideWidth;  // Adjust scrollLeft to keep the flow seamless
        }
    }

    // Set the initial auto-scroll interval
    let autoScrollInterval = setInterval(autoScroll, 1500);

    // Setup event listeners for mouse enter and mouse leave
    slider.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
    slider.addEventListener('mouseleave', () => autoScrollInterval = setInterval(autoScroll, 1500));
    slider.addEventListener('touchstart', () => clearInterval(autoScrollInterval), {passive: true});
    slider.addEventListener('touchend', () => autoScrollInterval = setInterval(autoScroll, 1500), {passive: true});
});
//BRAND SLIDES --END--

//INSTAGRAM SLIDES
document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.instagram-slides');
    let scrollAmount = 0;

    // Define the autoScroll function
    function autoScroll() {
        if (scrollAmount < slider.scrollWidth - slider.clientWidth) {
            scrollAmount += 317.16;  // Move by the width of one post
        } else {
            scrollAmount = 0;  // Reset the scroll
        }
        slider.scrollTo({ left: scrollAmount, behavior: 'smooth' });
    }

    // Initialize the auto-scroll interval
    let interval = setInterval(autoScroll, 1500);  // Change slide every 2 seconds

    // Set up event listeners for mouse and touch events to pause/resume auto-scroll
    slider.addEventListener('mouseenter', () => clearInterval(interval));
    slider.addEventListener('mouseleave', () => interval = setInterval(autoScroll, 1500));
    slider.addEventListener('touchstart', () => clearInterval(interval), {passive: true});
    slider.addEventListener('touchend', () => interval = setInterval(autoScroll, 1500), {passive: true});
});
// INSTAGRAM SLIDES --END--

document.addEventListener('DOMContentLoaded', function() {
    const stickyNavbar = document.querySelector('.header-sticky'); // Original sticky navbar
    const responsiveNavbar = document.querySelector('.xton-responsive-nav'); // Responsive navbar that needs sticky behavior

    let lastScrollTop = 0;

    function handleScroll() {
        const currentScrollTop = window.scrollY;
        // Function to add/remove sticky class
        function manageSticky(navbarElement) {
            if (currentScrollTop < lastScrollTop && currentScrollTop > 50) {
                // Check if the class needs to be added
                if (!navbarElement.classList.contains('is-sticky')) {
                    navbarElement.classList.add('is-sticky');
                    navbarElement.classList.remove('is-hidden');
                }
            } else if (navbarElement.classList.contains('is-sticky')) {
                // Check if the class needs to be removed
                navbarElement.classList.remove('is-sticky');
                navbarElement.classList.add('is-hidden');
            }
        }

        // Apply sticky behavior to both navbars
        manageSticky(stickyNavbar);
        manageSticky(responsiveNavbar);

        lastScrollTop = currentScrollTop; // Update lastScrollTop to the new scroll position for the next move
    }

    window.addEventListener('scroll', handleScroll);
});
//GO TO TOP BUTTON
document.addEventListener('DOMContentLoaded', function () {
    let goTopButton = document.querySelector('.go-top'); // Get the go-top button
    let arrowIcon = goTopButton.querySelector('i');
    // Scroll event listener
    window.addEventListener('scroll', function() {
        let scrolled = document.documentElement.scrollTop || document.body.scrollTop;
        if (scrolled > 300) {
            goTopButton.classList.add('active');
        } else {
            goTopButton.classList.remove('active');
            arrowIcon.classList.remove('hovered');
        }
    });

    // Click event listener for go-top button
    goTopButton.addEventListener('click', function() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const darkModeSwitch = document.getElementById('darkModeSwitch');

    // Function to set the theme
    function setTheme(theme) {
        if (theme === 'theme-dark') {
            document.body.classList.add('theme-dark');
            document.body.classList.remove('theme-light');
            localStorage.setItem('xton_theme', 'theme-dark');
        } else {
            document.body.classList.add('theme-light');
            document.body.classList.remove('theme-dark');
            localStorage.setItem('xton_theme', 'theme-light');
        }
    }

    // Initialize theme from local storage or default to light theme
    if (localStorage.getItem('xton_theme') === 'theme-dark') {
        setTheme('theme-dark');
        darkModeSwitch.checked = true; // Assuming checked means dark mode
    } else {
        setTheme('theme-light');
        darkModeSwitch.checked = false; // Assuming unchecked means light mode
    }

    // Event listener for changes on the dark mode switch
    darkModeSwitch.addEventListener('change', function() {
        if (this.checked) {
            setTheme('theme-dark');
        } else {
            setTheme('theme-light');
        }
    });
});



// Function to toggle the search overlay
function toggleSearchOverlay() {
    let searchOverlay = document.querySelector('.search-overlay');
    searchOverlay.classList.toggle('search-overlay-active');
}

// Attach event listeners to all elements with the class 'search-btn'
let searchButtons = document.querySelectorAll('.search-btn');
searchButtons.forEach(function(button) {
    button.addEventListener('click', toggleSearchOverlay);
});

// Function to close the search overlay
function closeSearchOverlay() {
    let searchOverlay = document.querySelector('.search-overlay');
    searchOverlay.classList.remove('search-overlay-active');
}

// Attach event listeners to all elements with the class 'search-overlay-close'
let closeButtons = document.querySelectorAll('.search-overlay-close');
closeButtons.forEach(function(button) {
    button.addEventListener('click', closeSearchOverlay);
});
