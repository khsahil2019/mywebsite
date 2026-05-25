document.addEventListener('DOMContentLoaded', () => {
    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar');
    
    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    // Smooth Scrolling for Nav Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const navHeight = navbar.offsetHeight;
                const targetPosition = targetElement.getBoundingClientRect().top + window.scrollY - navHeight;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Scroll Reveal Animation
    const revealElements = document.querySelectorAll('.scroll-reveal');
    
    const revealCallback = (entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                // Optional: Stop observing once revealed
                // observer.unobserve(entry.target);
            }
        });
    };
    
    const revealOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px"
    };
    
    const revealObserver = new IntersectionObserver(revealCallback, revealOptions);
    
    revealElements.forEach(el => revealObserver.observe(el));
    
    // Typewriter Effect for Title
    const titleElement = document.querySelector('.type-writer');
    if (titleElement) {
        const text = titleElement.innerText;
        titleElement.innerText = '';
        let i = 0;
        
        function typeWriter() {
            if (i < text.length) {
                titleElement.innerHTML += text.charAt(i);
                i++;
                setTimeout(typeWriter, 50);
            } else {
                // Add blinking cursor effect
                titleElement.innerHTML += '<span class="cursor" style="animation: blink 1s step-end infinite;">_</span>';
                
                // Add CSS for blinking cursor dynamically
                const style = document.createElement('style');
                style.innerHTML = `@keyframes blink { 0%, 100% { opacity: 1; } 50% { opacity: 0; } }`;
                document.head.appendChild(style);
            }
        }
        
        // Start after a small delay
        setTimeout(typeWriter, 500);
    }
});
