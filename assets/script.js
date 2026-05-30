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

    // Fetch and display GitHub Repositories
    const reposGrid = document.getElementById('github-repos-grid');
    if (reposGrid) {
        const username = 'khsahil2019';
        const fallbackRepos = [
            {
                name: 'kt_travel',
                description: 'Travel planning and booking platform built with Flutter and Dart.',
                html_url: 'https://github.com/khsahil2019/kt_travel',
                language: 'Dart',
                stargazers_count: 1,
                forks_count: 0
            },
            {
                name: 'doctors_pecialist',
                description: 'Doctor specialist viewlist locator app developed using Flutter.',
                html_url: 'https://github.com/khsahil2019/doctors_pecialist',
                language: 'Dart',
                stargazers_count: 0,
                forks_count: 0
            },
            {
                name: 'MY_SMALL_PROJECT',
                description: 'Collection of various Java DSA and utility projects.',
                html_url: 'https://github.com/khsahil2019/MY_SMALL_PROJECT',
                language: 'Java',
                stargazers_count: 0,
                forks_count: 0
            },
            {
                name: 'flutter-code',
                description: 'A repository featuring custom Flutter and Dart code snippets.',
                html_url: 'https://github.com/khsahil2019/flutter-code',
                language: 'Dart',
                stargazers_count: 0,
                forks_count: 0
            },
            {
                name: 'fisrtproject',
                description: 'A PHP-based dynamic web application project.',
                html_url: 'https://github.com/khsahil2019/fisrtproject',
                language: 'PHP',
                stargazers_count: 0,
                forks_count: 0
            }
        ];

        function renderRepos(repos) {
            reposGrid.innerHTML = '';
            repos.forEach((repo, index) => {
                const card = document.createElement('div');
                card.className = 'repo-card glass-panel scroll-reveal';
                card.style.transitionDelay = `${(index % 3) * 0.1}s`;
                
                // Set appropriate icon based on language
                let langIcon = 'fa-solid fa-code';
                if (repo.language) {
                    const lang = repo.language.toLowerCase();
                    if (lang === 'dart' || lang === 'flutter') langIcon = 'fa-brands fa-flutter';
                    else if (lang === 'java') langIcon = 'fa-brands fa-java';
                    else if (lang === 'php') langIcon = 'fa-brands fa-php';
                    else if (lang === 'javascript' || lang === 'js') langIcon = 'fa-brands fa-js';
                    else if (lang === 'html') langIcon = 'fa-brands fa-html5';
                    else if (lang === 'css') langIcon = 'fa-brands fa-css3-alt';
                    else if (lang === 'c') langIcon = 'fa-solid fa-copyright';
                }

                card.innerHTML = `
                    <div class="repo-header">
                        <div class="repo-folder-icon">
                            <i class="${langIcon}"></i>
                        </div>
                        <div class="repo-links">
                            <a href="${repo.html_url}" target="_blank" aria-label="View on GitHub"><i class="fa-brands fa-github"></i></a>
                        </div>
                    </div>
                    <h4 class="repo-title">${repo.name}</h4>
                    <p class="repo-desc">${repo.description || 'No description provided.'}</p>
                    <div class="repo-footer">
                        <div class="repo-left-stats">
                            <div class="repo-stat-item">
                                <i class="fa-regular fa-star"></i>
                                <span>${repo.stargazers_count}</span>
                            </div>
                            <div class="repo-stat-item">
                                <i class="fa-solid fa-code-fork"></i>
                                <span>${repo.forks_count}</span>
                            </div>
                        </div>
                        ${repo.language ? `<span class="repo-lang">${repo.language}</span>` : ''}
                    </div>
                `;
                reposGrid.appendChild(card);
                
                // Trigger IntersectionObserver
                if (typeof revealObserver !== 'undefined') {
                    revealObserver.observe(card);
                } else {
                    card.classList.add('visible');
                }
            });
        }

        // Fetch from API
        fetch(`https://api.github.com/users/${username}/repos?sort=updated&per_page=7`)
            .then(response => {
                if (!response.ok) throw new Error('API request failed');
                return response.json();
            })
            .then(data => {
                // Filter out profile README repository
                const filteredRepos = data.filter(repo => repo.name.toLowerCase() !== username.toLowerCase());
                if (filteredRepos.length > 0) {
                    renderRepos(filteredRepos.slice(0, 6));
                } else {
                    renderRepos(fallbackRepos);
                }
            })
            .catch(error => {
                console.warn('GitHub API error, rendering fallback repositories:', error);
                renderRepos(fallbackRepos);
            });
    }
});
