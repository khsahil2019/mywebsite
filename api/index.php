<?php
// Dynamic data for the portfolio
$name = "Sahil Khan";
$title = "Flutter Developer & Mobile Engineer";
$about = "I am a passionate Flutter Developer and Software Engineer crafting high-performance, cross-platform mobile applications. With deep expertise in GetX, REST APIs, and modern UI/UX design, I build seamless digital experiences from concept to deployment. I thrive in architecting robust, scalable solutions like TrioTrip and Spexsa, delivering premium interfaces that feel dynamic and alive.";
$email = "hello@mastersahilkhan.com"; // Placeholder email
$linkedin = "https://www.linkedin.com/in/mastersahilkhan/";
$github = "https://github.com/mastersahilkhan"; // Placeholder GitHub

$experience = [
    [
        "role" => "Senior Flutter Developer",
        "company" => "Tech & Software Solutions",
        "period" => "2023 - Present",
        "description" => "Architecting and building production-ready scalable mobile applications. Led the development of TrioTrip, a complete smart tourism ecosystem, integrating AI trip generation, state-to-place hierarchy, and complex navigation flows."
    ],
    [
        "role" => "Mobile App Developer",
        "company" => "Creative App Studios",
        "period" => "2021 - 2023",
        "description" => "Developed cross-platform mobile apps for enterprise clients. Specialized in GetX state management, REST API integration, and creating smooth, animated UIs. Contributed to core architecture layers for high-performance apps like Spexsa."
    ],
    [
        "role" => "Junior Software Engineer",
        "company" => "StartUp Innovations",
        "period" => "2020 - 2021",
        "description" => "Assisted in building full-stack web and mobile apps. Handled PHP/MySQL backend endpoints and built foundational Flutter UI components. Focused heavily on UI/UX precision and responsive designs."
    ]
];

$projects = [
    [
        "title" => "TrioTrip Smart Tourism",
        "description" => "A comprehensive smart tourism ecosystem app providing AI-powered itinerary generation, dynamic data integration, and detailed navigation through Indian states and tourist destinations.",
        "tags" => ["Flutter", "GetX", "PHP", "MySQL", "AI"],
        "icon" => "fa-solid fa-map-location-dot",
        "link" => "#"
    ],
    [
        "title" => "Spexsa Premium Mobile",
        "description" => "A premium cross-platform mobile application featuring state-of-the-art UI/UX, built with highly optimized performance and seamless, fluid micro-animations.",
        "tags" => ["Flutter", "Dart", "REST API", "UI/UX"],
        "icon" => "fa-solid fa-mobile-screen-button",
        "link" => "#"
    ],
    [
        "title" => "E-Commerce Market Suite",
        "description" => "A full-fledged e-commerce application with real-time inventory tracking, secure payment gateways, and a customized admin dashboard for order management.",
        "tags" => ["Flutter", "Firebase", "Stripe", "Node.js"],
        "icon" => "fa-solid fa-cart-shopping",
        "link" => "#"
    ],
    [
        "title" => "HealthTrack Pro",
        "description" => "A fitness and health tracking application allowing users to monitor daily metrics, view interactive charts, and receive customized AI-driven health tips.",
        "tags" => ["Flutter", "HealthKit", "Charts", "Dart"],
        "icon" => "fa-solid fa-heart-pulse",
        "link" => "#"
    ],
    [
        "title" => "API Service Core",
        "description" => "A robust backend service layer built in Dart for handling complex network requests, automated token refresh, and dynamic data caching strategies.",
        "tags" => ["Dart", "Network", "Architecture"],
        "icon" => "fa-solid fa-server",
        "link" => "#"
    ],
    [
        "title" => "Real Estate Explorer",
        "description" => "An intuitive property exploration app featuring interactive maps, 3D virtual tours, and real-time messaging between agents and buyers.",
        "tags" => ["Flutter", "Google Maps", "WebSockets"],
        "icon" => "fa-solid fa-building",
        "link" => "#"
    ]
];

$skills = ["Flutter", "Dart", "GetX", "PHP", "MySQL", "REST APIs", "UI/UX Design", "Git", "Firebase", "Figma"];

// Helper function for rendering skill badges
function renderSkill($skill) {
    return "<span class='skill-badge'>{$skill}</span>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portfolio of Sahil Khan, a passionate Flutter Developer.">
    <title><?= $name ?> | <?= $title ?></title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body class="dark-theme">
    <!-- Background Elements -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>
    <div class="bg-shape shape-3"></div>

    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="logo">S<span class="highlight">K</span></a>
            <ul class="nav-links">
                <li><a href="#about">About</a></li>
                <li><a href="#experience">Experience</a></li>
                <li><a href="#projects">Projects</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="hero-content fade-in">
                <span class="greeting">Hello, I'm</span>
                <h1 class="name"><?= $name ?></h1>
                <h2 class="title type-writer"><?= $title ?></h2>
                <p class="description">Building premium digital products, brands, and experiences through robust code and stunning UI/UX design.</p>
                
                <div class="action-buttons">
                    <a href="#projects" class="btn btn-primary">View My Work</a>
                    <a href="<?= $linkedin ?>" target="_blank" class="btn btn-outline"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
                </div>
            </div>
            <div class="hero-image fade-in-right">
                <div class="image-wrapper">
                    <!-- Updated image src to use the local uploaded photo -->
                    <img src="/assets/profile.jpg" alt="Sahil Khan" class="profile-img" onerror="this.src='https://ui-avatars.com/api/?name=Sahil+Khan&size=512&background=random&color=fff&font-size=0.33'">
                    <div class="floating-badge badge-1"><i class="fa-brands fa-flutter"></i></div>
                    <div class="floating-badge badge-2"><i class="fa-brands fa-php"></i></div>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="about section-padding">
            <h3 class="section-title">About <span class="highlight">Me</span></h3>
            <div class="about-grid">
                <div class="about-text scroll-reveal">
                    <p><?= $about ?></p>
                    <div class="skills-container">
                        <h4>My Toolkit</h4>
                        <div class="skills-list">
                            <?php foreach($skills as $skill): ?>
                                <?= renderSkill($skill) ?>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <div class="about-stats scroll-reveal">
                    <div class="stat-card glass-panel">
                        <h3>3+</h3>
                        <p>Years Experience</p>
                    </div>
                    <div class="stat-card glass-panel">
                        <h3>15+</h3>
                        <p>Projects Completed</p>
                    </div>
                    <div class="stat-card glass-panel">
                        <h3>100%</h3>
                        <p>Client Satisfaction</p>
                    </div>
                    <div class="stat-card glass-panel">
                        <h3>1M+</h3>
                        <p>Lines of Code</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Experience Section -->
        <section id="experience" class="experience section-padding">
            <h3 class="section-title">My <span class="highlight">Experience</span></h3>
            <div class="timeline">
                <?php foreach($experience as $index => $job): ?>
                    <div class="timeline-item scroll-reveal" style="transition-delay: <?= $index * 0.1 ?>s;">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content glass-panel">
                            <span class="period"><?= $job['period'] ?></span>
                            <h4 class="role"><?= $job['role'] ?></h4>
                            <h5 class="company"><i class="fa-solid fa-building"></i> <?= $job['company'] ?></h5>
                            <p class="desc"><?= $job['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="projects section-padding">
            <h3 class="section-title">Featured <span class="highlight">Projects</span></h3>
            <div class="projects-grid">
                <?php foreach($projects as $index => $project): ?>
                    <div class="project-card glass-panel scroll-reveal" style="transition-delay: <?= ($index % 3) * 0.1 ?>s;">
                        <div class="project-icon">
                            <i class="<?= $project['icon'] ?>"></i>
                        </div>
                        <h4 class="project-title"><?= $project['title'] ?></h4>
                        <p class="project-desc"><?= $project['description'] ?></p>
                        <div class="project-tags">
                            <?php foreach($project['tags'] as $tag): ?>
                                <span class="tag"><?= $tag ?></span>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= $project['link'] ?>" class="project-link">View Project <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact section-padding">
            <div class="contact-box glass-panel scroll-reveal">
                <h3 class="section-title">Let's Work <span class="highlight">Together</span></h3>
                <p>I'm currently available for freelance work and open to new opportunities. Whether you have a project to discuss or just want to say hi, my inbox is open!</p>
                <a href="mailto:<?= $email ?>" class="btn btn-primary btn-large">Say Hello</a>
                <div class="social-links">
                    <a href="<?= $linkedin ?>" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="<?= $github ?>" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                </div>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; <?= date("Y") ?> <?= $name ?>. All rights reserved.</p>
    </footer>

    <!-- Scripts -->
    <script src="/assets/script.js"></script>
</body>
</html>
