<?php
// Start session for admin panel
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Load data from data.json
$dataPath = __DIR__ . '/data.json';
$data = [];
if (file_exists($dataPath)) {
    $data = json_decode(file_get_contents($dataPath), true);
}

// Fallbacks
$name = isset($data['name']) ? $data['name'] : "Sahil Khan";
$title = isset($data['title']) ? $data['title'] : "Flutter Developer & Mobile Engineer";
$about = isset($data['about']) ? $data['about'] : "I am a passionate Flutter Developer and Software Engineer crafting high-performance, cross-platform mobile applications.";
$email = isset($data['email']) ? $data['email'] : "hello@mastersahilkhan.com";
$linkedin = isset($data['linkedin']) ? $data['linkedin'] : "https://www.linkedin.com/in/mastersahilkhan/";
$github = isset($data['github']) ? $data['github'] : "https://github.com/mastersahilkhan";
$skills = isset($data['skills']) ? $data['skills'] : ["Flutter", "Dart", "GetX", "PHP", "MySQL", "REST APIs"];
$stats = isset($data['stats']) ? $data['stats'] : [
    ["label" => "Years Experience", "value" => "3+"],
    ["label" => "Projects Completed", "value" => "15+"],
    ["label" => "DSA Questions", "value" => "120+"],
    ["label" => "Satisfaction Rate", "value" => "100%"]
];
$experience = isset($data['experience']) ? $data['experience'] : [];
$projects = isset($data['projects']) ? $data['projects'] : [];
$education = isset($data['education']) ? $data['education'] : [];
$certifications = isset($data['certifications']) ? $data['certifications'] : [];

// Routing logic
$request_uri = $_SERVER['REQUEST_URI'];
$request_path = parse_url($request_uri, PHP_URL_PATH);

// Admin APIs
if ($request_path === '/admin/api/login') {
    header('Content-Type: application/json');
    $input = json_decode(file_get_contents('php://input'), true);
    if (isset($input['password']) && $input['password'] === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        echo json_encode(["success" => true]);
    } else {
        http_response_code(401);
        echo json_encode(["success" => false, "message" => "Invalid password"]);
    }
    exit;
}

if ($request_path === '/admin/api/logout') {
    $_SESSION['admin_logged_in'] = false;
    session_destroy();
    header('Location: /admin');
    exit;
}

if ($request_path === '/admin/api/save') {
    header('Content-Type: application/json');
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        http_response_code(403);
        echo json_encode(["success" => false, "message" => "Unauthorized"]);
        exit;
    }
    $input = json_decode(file_get_contents('php://input'), true);
    if ($input) {
        $result = @file_put_contents($dataPath, json_encode($input, JSON_PRETTY_PRINT));
        if ($result !== false) {
            echo json_encode(["success" => true]);
        } else {
            echo json_encode([
                "success" => false, 
                "message" => "Failed to write to data.json. Filesystem might be read-only (e.g. Vercel). You can download your data.json instead.",
                "readOnly" => true
            ]);
        }
    } else {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "Invalid input"]);
    }
    exit;
}

if ($request_path === '/admin/api/download') {
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        http_response_code(403);
        die("Unauthorized");
    }
    header('Content-Type: application/json');
    header('Content-Disposition: attachment; filename="data.json"');
    echo file_get_contents($dataPath);
    exit;
}

// Check if request is for admin panel
if (strpos($request_path, '/admin') === 0) {
    include __DIR__ . '/admin.php';
    exit;
}

// Helper function for rendering skill badges
function renderSkill($skill) {
    return "<span class='skill-badge'>" . htmlspecialchars($skill) . "</span>";
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
                <li><a href="#education">Education</a></li>
                <li><a href="#contact">Contact</a></li>
            </ul>
        </div>
    </nav>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="hero-content fade-in">
                <div class="greeting-row">
                    <span class="greeting">Hello, I'm</span>
                    <span class="badge-status"><span class="status-dot"></span> Open For Opportunities</span>
                </div>
                <h1 class="name"><?= htmlspecialchars($name) ?></h1>
                <h2 class="title type-writer"><?= htmlspecialchars($title) ?></h2>
                <p class="description">Building premium digital products, brands, and experiences through robust code and stunning UI/UX design.</p>
                
                <div class="action-buttons">
                    <a href="#projects" class="btn btn-primary">View My Work</a>
                    <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" class="btn btn-outline"><i class="fa-brands fa-linkedin"></i> LinkedIn</a>
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
                    <p><?= htmlspecialchars($about) ?></p>
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
                    <?php foreach($stats as $stat): ?>
                        <div class="stat-card glass-panel">
                            <h3><?= htmlspecialchars($stat['value']) ?></h3>
                            <p><?= htmlspecialchars($stat['label']) ?></p>
                        </div>
                    <?php endforeach; ?>
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
                            <span class="period"><?= htmlspecialchars($job['period']) ?></span>
                            <h4 class="role"><?= htmlspecialchars($job['role']) ?></h4>
                            <h5 class="company"><i class="fa-solid fa-building"></i> <?= htmlspecialchars($job['company']) ?></h5>
                            <p class="desc"><?= htmlspecialchars($job['description']) ?></p>
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
                            <i class="<?= htmlspecialchars($project['icon']) ?>"></i>
                        </div>
                        <h4 class="project-title"><?= htmlspecialchars($project['title']) ?></h4>
                        <p class="project-desc"><?= htmlspecialchars($project['description']) ?></p>
                        <div class="project-tags">
                            <?php foreach($project['tags'] as $tag): ?>
                                <span class="tag"><?= htmlspecialchars($tag) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= htmlspecialchars($project['link']) ?>" class="project-link" <?= $project['link'] !== '#' ? 'target="_blank"' : '' ?>>View Project <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>

        <!-- Education Section -->
        <section id="education" class="education section-padding">
            <h3 class="section-title">Education & <span class="highlight">Qualifications</span></h3>
            <div class="education-grid">
                <?php foreach($education as $index => $edu): ?>
                    <div class="education-card glass-panel scroll-reveal" style="transition-delay: <?= $index * 0.1 ?>s;">
                        <span class="period"><?= htmlspecialchars($edu['period']) ?></span>
                        <h4 class="degree"><?= htmlspecialchars($edu['degree']) ?></h4>
                        <h5 class="institution"><i class="fa-solid fa-university"></i> <?= htmlspecialchars($edu['institution']) ?></h5>
                        <?php if(!empty($edu['grade'])): ?>
                            <p class="grade"><?= htmlspecialchars($edu['grade']) ?></p>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if(!empty($certifications)): ?>
                <h3 class="section-title" style="margin-top: 80px;">Key Achievements & <span class="highlight">Certifications</span></h3>
                <div class="certifications-grid">
                    <?php foreach($certifications as $index => $cert): ?>
                        <div class="certification-card glass-panel scroll-reveal" style="transition-delay: <?= $index * 0.1 ?>s;">
                            <div class="cert-icon">
                                <i class="fa-solid fa-award"></i>
                            </div>
                            <div class="cert-content">
                                <h4 class="cert-title"><?= htmlspecialchars($cert['title']) ?></h4>
                                <p class="cert-desc"><?= htmlspecialchars($cert['description']) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="contact section-padding">
            <div class="contact-box glass-panel scroll-reveal">
                <h3 class="section-title">Let's Work <span class="highlight">Together</span></h3>
                <p>I'm currently available for freelance work and open to new opportunities. Whether you have a project to discuss or just want to say hi, my inbox is open!</p>
                <a href="mailto:<?= htmlspecialchars($email) ?>" class="btn btn-primary btn-large">Say Hello</a>
                <div class="social-links">
                    <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank" aria-label="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a>
                    <a href="<?= htmlspecialchars($github) ?>" target="_blank" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
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
