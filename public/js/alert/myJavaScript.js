document.addEventListener('DOMContentLoaded', function() {
    const flashMessage = document.getElementById('flash-message');

    if (flashMessage) {
        setTimeout(function() {
            flashMessage.style.transition = 'opacity 0.5s ease';
            flashMessage.style.opacity = '0';

            setTimeout(function() {
                flashMessage.remove();
            }, 500);

        }, 3000);
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        let isMenuOpen = false;
        const menuLinks = mobileMenu.querySelectorAll('a');
        const animationDuration = 300;

        const toggleMobileMenu = () => {
            if (isMenuOpen) {
                mobileMenu.classList.remove('invisible', 'opacity-0', 'scale-95');
                mobileMenu.classList.add('opacity-100', 'scale-100');
                mobileMenuButton.innerHTML = `<i data-feather="x" class="w-6 h-6"></i>`;
            } else {
                mobileMenu.classList.remove('opacity-100', 'scale-100');
                mobileMenu.classList.add('opacity-0', 'scale-95');
                setTimeout(() => mobileMenu.classList.add('invisible'), animationDuration);
                mobileMenuButton.innerHTML = `<i data-feather="menu" class="w-6 h-6"></i>`;
            }
            feather.replace();
        };

        const closeMobileMenu = () => {
            isMenuOpen = false;
            mobileMenu.classList.remove('opacity-100', 'scale-100');
            mobileMenu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => mobileMenu.classList.add('invisible'), animationDuration);
            mobileMenuButton.innerHTML = `<i data-feather="menu" class="w-6 h-6"></i>`;
            feather.replace();
        };

        mobileMenuButton.addEventListener('click', function(event) {
            event.stopPropagation();
            isMenuOpen = !isMenuOpen;
            toggleMobileMenu();
        });

        document.addEventListener('click', function(event) {
            if (isMenuOpen &&
                !mobileMenu.contains(event.target) &&
                !mobileMenuButton.contains(event.target)) {
                closeMobileMenu();
            }
        });

        menuLinks.forEach(link => {
            link.addEventListener('click', closeMobileMenu);
        });
    }
});


document.addEventListener('DOMContentLoaded', function() {
    const slider = document.querySelector('.slider');
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.pagination-dots');
    const prevBtn = document.querySelector('#prev');
    const nextBtn = document.querySelector('#next');

    let currentIndex = 0;
    const intervalTime = 5000;
    let slideInterval;
    let direction = 1;

    function nextSlide() {
        const nextIndex = currentIndex + direction;

        if (nextIndex >= slides.length || nextIndex < 0) {
            direction *= -1;
            goToSlide(currentIndex + direction);
        } else {
            goToSlide(nextIndex);
        }
    }

    function startAutoScroll() {
        slideInterval = setInterval(nextSlide, intervalTime);
    }

    function stopAutoScroll() {
        clearInterval(slideInterval);
    }

    if (slides.length > 1) {
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

    function updateDots() {
        dots.forEach((dot, index) => {
            dot.classList.toggle('bg-white', index === currentIndex);
            dot.classList.toggle('bg-white/60', index !== currentIndex);
        });
    }

    function goToSlide(index) {
        currentIndex = index;
        slider.scrollTo({
            left: slides[index].offsetLeft,
            top: 0,
            behavior: 'smooth'
        });
        updateDots();
    }

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


document.addEventListener('DOMContentLoaded', function() {
    const backToTopButton = document.getElementById('back-to-top');

    if (backToTopButton) {
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
    }

    const categorySections = document.querySelectorAll('section[id^="kategori-"]');
    const categoryLinks = document.querySelectorAll('.category-nav-link');

    if (categorySections.length && categoryLinks.length) {
        function highlightActiveCategory() {
            let currentSection = '';

            categorySections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (window.pageYOffset >= sectionTop - 150 &&
                    window.pageYOffset < sectionTop + sectionHeight - 150) {
                    currentSection = section.getAttribute('id');
                }
            });

            categoryLinks.forEach(link => {
                link.classList.toggle('active', link.getAttribute('href') === `#${currentSection}`);
            });
        }

        window.addEventListener('scroll', highlightActiveCategory);
        highlightActiveCategory();
    }
});


document.addEventListener('DOMContentLoaded', function() {

    const quantityInput = document.getElementById('quantity');
    const buyNowQuantity = document.getElementById('buy-now-quantity');
    const incrementBtn = document.querySelector('.increment-qty');
    const decrementBtn = document.querySelector('.decrement-qty');
    const maxQuantity = parseInt(quantityInput.max) || 20;

    function updateQuantity(value) {
        value = Math.max(1, Math.min(maxQuantity, value));
        quantityInput.value = value;
        buyNowQuantity.value = value;
    }

    if (incrementBtn) {
        incrementBtn.addEventListener('click', function() {
            updateQuantity(parseInt(quantityInput.value) + 1);
        });
    }

    if (decrementBtn) {
        decrementBtn.addEventListener('click', function() {
            updateQuantity(parseInt(quantityInput.value) - 1);
        });
    }

    if (quantityInput) {
        quantityInput.addEventListener('change', function() {
            updateQuantity(parseInt(this.value));
        });
    }

    const mainImage = document.getElementById('main-product-image');
    if (mainImage) {
        mainImage.addEventListener('click', function() {
            this.classList.toggle('zoomed');
            this.style.transform = this.classList.contains('zoomed') ? 'scale(1.5)' : 'scale(1)';
            this.style.cursor = this.classList.contains('zoomed') ? 'zoom-out' : 'zoom-in';
        });
    }

    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            if (!button) return;

            const originalText = button.innerHTML;
            const originalDisabled = button.disabled;

            button.innerHTML = `
                <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Processing...
            `;
            button.disabled = true;

            setTimeout(() => {
                if (!this.classList.contains('submitted')) {
                    button.innerHTML = originalText;
                    button.disabled = originalDisabled;
                }
            }, 3000);
        });
    });
});
