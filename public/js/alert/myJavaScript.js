// massage
document.addEventListener('DOMContentLoaded', function () {
const flash = document.getElementById('flash-message');
if (flash) {
setTimeout(() => {
flash.style.transition = 'opacity 0.5s ease';
flash.style.opacity = '0';

setTimeout(() => {
flash.remove();
}, 500);
}, 3000);
}
});

// humburger menu
document.addEventListener('DOMContentLoaded', function () {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        let isMenuOpen = false;

        mobileMenuButton.addEventListener('click', function (event) {
            event.stopPropagation();

            isMenuOpen = !isMenuOpen;

            if (isMenuOpen) {
                mobileMenu.classList.remove('invisible', 'opacity-0', 'scale-95');
                mobileMenu.classList.add('opacity-100', 'scale-100');

                // Ganti ikon menjadi "x"
                mobileMenuButton.innerHTML = `<i id="hamburger-menu" data-feather="x" class="w-6 h-6"></i>`;
            } else {
                mobileMenu.classList.remove('opacity-100', 'scale-100');
                mobileMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    mobileMenu.classList.add('invisible');
                }, 300);

                // Ganti ikon menjadi "menu"
                mobileMenuButton.innerHTML = `<i id="hamburger-menu" data-feather="menu" class="w-6 h-6"></i>`;
            }

            feather.replace();
        });

        // Klik di luar menu
        document.addEventListener('click', function (event) {
            if (!mobileMenu.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                isMenuOpen = false;
                mobileMenu.classList.remove('opacity-100', 'scale-100');
                mobileMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    mobileMenu.classList.add('invisible');
                }, 300);

                mobileMenuButton.innerHTML = `<i id="hamburger-menu" data-feather="menu" class="w-6 h-6"></i>`;
                feather.replace();
            }
        });

        // Klik link menu = tutup menu
        const menuLinks = mobileMenu.querySelectorAll('a');
        menuLinks.forEach(link => {
            link.addEventListener('click', function () {
                isMenuOpen = false;
                mobileMenu.classList.remove('opacity-100', 'scale-100');
                mobileMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => {
                    mobileMenu.classList.add('invisible');
                }, 300);

                mobileMenuButton.innerHTML = `<i id="hamburger-menu" data-feather="menu" class="w-6 h-6"></i>`;
                feather.replace();
            });
        });
    }
});



// auto slide
document.addEventListener('DOMContentLoaded', function() {
const slider = document.querySelector('.slider');
const slides = document.querySelectorAll('.slide');
const dots = document.querySelectorAll('.absolute.bottom-4 span');
const prevBtn = document.querySelector('#prev');
const nextBtn = document.querySelector('#next');

let currentIndex = 0;

const intervalTime = 5000;
let slideInterval;
let direction = 1;

function nextSlide() {
const nextIndex = currentIndex + direction;

if (nextIndex >= slides.length || nextIndex < 0) {
    direction *=-1;
    goToSlide(currentIndex + direction);
    } else {
    goToSlide(nextIndex);
    }
    }
    function startAutoScroll() {
    slideInterval=setInterval(nextSlide, intervalTime);
    }
    function stopAutoScroll() {
    clearInterval(slideInterval);
    }
    if (slides.length> 1) {
    startAutoScroll();

    slider.addEventListener('mouseenter', stopAutoScroll);

    slider.addEventListener('mouseleave', startAutoScroll);

    document.addEventListener('visibilitychange', function() {
    if (document.hidden) {
    stopAutoScroll();
    } else {
    startAutoScroll();
    }
    });
    }

    // Update active dot
    function updateDots() {
    dots.forEach((dot, index) => {
    dot.classList.toggle('bg-white', index === currentIndex);
    dot.classList.toggle('bg-white/60', index !== currentIndex);
    });
    }

    // Scroll to slide
    function goToSlide(index) {
    currentIndex = index;
    slider.scrollTo({
    left: slides[index].offsetLeft,
    top: 0, // Pastikan tidak ada scroll vertikal
    behavior: 'smooth'
    });
    updateDots();
    }

    // Event listeners
    dots.forEach((dot, index) => {
    dot.addEventListener('click', () => goToSlide(index));
    });

    prevBtn.addEventListener('click', () => {
    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
    goToSlide(currentIndex);
    });

    nextBtn.addEventListener('click', () => {
    currentIndex = (currentIndex + 1) % slides.length;
    goToSlide(currentIndex);
    });
    });

// Memories


// #
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top Button
    const backToTopButton = document.getElementById('back-to-top');

    window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
    backToTopButton.classList.remove('opacity-0', 'invisible');
    backToTopButton.classList.add('opacity-100', 'visible');
    } else {
    backToTopButton.classList.remove('opacity-100', 'visible');
    backToTopButton.classList.add('opacity-0', 'invisible');
    }
    });

    backToTopButton.addEventListener('click', function() {
    window.scrollTo({
    top: 0,
    behavior: 'smooth'
    });
    });

    // Highlight active category in navigation
    const categorySections = document.querySelectorAll('section[id^="kategori-"]');
    const categoryLinks = document.querySelectorAll('.category-nav-link');

    function highlightActiveCategory() {
    let currentSection = '';

    categorySections.forEach(section => {
    const sectionTop = section.offsetTop;
    const sectionHeight = section.clientHeight;

    if (window.pageYOffset >= sectionTop - 150 && window.pageYOffset < sectionTop + sectionHeight - 150) {
        currentSection=section.getAttribute('id');
        }
        });

        categoryLinks.forEach(link=> {
        link.classList.remove('active');
        if (link.getAttribute('href') === `#${currentSection}`) {
        link.classList.add('active');
        }
        });
        }

        window.addEventListener('scroll', highlightActiveCategory);
        highlightActiveCategory(); // Run once on load

        // Add to cart animation
        const addToCartForms = document.querySelectorAll('form[action="{{ route("cart.add") }}"]');

        addToCartForms.forEach(form => {
        form.addEventListener('submit', function(e) {
        e.preventDefault();

        const button = this.querySelector('button[type="submit"]');
        const originalText = button.innerHTML;

        // Show loading state
        button.innerHTML = `
        <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Adding...
        `;
        button.disabled = true;

        // Simulate API call (replace with actual fetch)
        setTimeout(() => {
        // Submit the form after animation
        this.submit();
        }, 1000);
        });
        });
        });


// #
document.addEventListener('DOMContentLoaded', function() {
        // Quantity Selector
        const quantityInput = document.getElementById('quantity');
        const buyNowQuantity = document.getElementById('buy-now-quantity');

        document.querySelector('.increment-qty').addEventListener('click', function() {
        let value = parseInt(quantityInput.value);
        const max = parseInt(quantityInput.max) || 20;
        if (value < max) {
            quantityInput.value=value + 1;
            buyNowQuantity.value=quantityInput.value;
            }
            });

            document.querySelector('.decrement-qty').addEventListener('click', function() {
            let value=parseInt(quantityInput.value);
            if (value> 1) {
            quantityInput.value = value - 1;
            buyNowQuantity.value = quantityInput.value;
            }
            });

            quantityInput.addEventListener('change', function() {
            let value = parseInt(this.value);
            const max = parseInt(this.max) || 20;
            if (isNaN(value) || value < 1) {
                this.value=1;
                } else if (value> max) {
                this.value = max;
                }
                buyNowQuantity.value = this.value;
                });

                // Image Zoom
                const mainImage = document.getElementById('main-product-image');
                if (mainImage) {
                mainImage.addEventListener('click', function() {
                this.classList.toggle('zoomed');
                });
                }

                // Add to Cart/Buy Now Button Loading States
                const forms = document.querySelectorAll('form');

                forms.forEach(form => {
                form.addEventListener('submit', function(e) {
                const button = this.querySelector('button[type="submit"]');
                const originalText = button.innerHTML;

                // Show loading state
                button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
                `;
                button.disabled = true;

                // Revert after 3 seconds if submission fails
                setTimeout(() => {
                if (!this.classList.contains('submitted')) {
                button.innerHTML = originalText;
                button.disabled = false;
                }
                }, 3000);
                });
                });
                });

