<?php
// Secure admin panel check
if (!isset($_SESSION)) {
    session_start();
}

$is_logged_in = isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;

// Get current data for initialization
$dataPath = __DIR__ . '/data.json';
$current_data = [];
if (file_exists($dataPath)) {
    $current_data = json_decode(file_get_contents($dataPath), true);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portfolio Admin Panel</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --bg-main: #0B0C10;
            --bg-secondary: #1C2331;
            --bg-tertiary: #252F44;
            --text-main: #C5C6C7;
            --text-light: #E0E2E4;
            --accent: #45A29E;
            --accent-glow: rgba(69, 162, 158, 0.4);
            --accent-light: #66FCF1;
            --danger: #FF4A4A;
            --danger-glow: rgba(255, 74, 74, 0.3);
            --success: #2EC4B6;
            --glass-bg: rgba(28, 35, 49, 0.7);
            --glass-border: rgba(102, 252, 241, 0.12);
            --transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-main);
            color: var(--text-main);
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: 'Outfit', sans-serif;
            color: var(--text-light);
            font-weight: 600;
        }

        /* Login Layout */
        .login-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            position: relative;
        }

        .bg-shape {
            position: fixed;
            border-radius: 50%;
            filter: blur(120px);
            z-index: -1;
            opacity: 0.5;
        }

        .shape-1 {
            width: 400px;
            height: 400px;
            background: var(--accent);
            top: -100px;
            left: -100px;
        }

        .shape-2 {
            width: 300px;
            height: 300px;
            background: #8e2de2;
            bottom: -50px;
            right: -50px;
        }

        .login-card {
            background: var(--glass-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 45px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.5);
            text-align: center;
            transition: var(--transition);
        }

        .login-logo {
            font-size: 32px;
            font-weight: 800;
            margin-bottom: 10px;
            letter-spacing: 2px;
            font-family: 'Outfit', sans-serif;
        }

        .highlight {
            color: var(--accent-light);
            text-shadow: 0 0 15px var(--accent-glow);
        }

        .login-subtitle {
            color: #8892B0;
            font-size: 15px;
            margin-bottom: 35px;
        }

        .form-group {
            margin-bottom: 25px;
            text-align: left;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: var(--text-light);
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #8892B0;
            font-size: 16px;
        }

        .form-control {
            width: 100%;
            background: var(--bg-tertiary);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 14px 15px 14px 45px;
            color: #fff;
            font-size: 16px;
            transition: var(--transition);
            font-family: 'Inter', sans-serif;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--accent-light);
            box-shadow: 0 0 10px rgba(102, 252, 241, 0.2);
            background: var(--bg-secondary);
        }

        textarea.form-control {
            padding-left: 15px;
            min-height: 120px;
            resize: vertical;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--accent), var(--accent-light));
            border: none;
            border-radius: 12px;
            color: #0B0C10;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px var(--accent-glow);
            filter: brightness(1.05);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--accent-light);
            color: var(--accent-light);
        }

        .btn-outline:hover {
            background: rgba(102, 252, 241, 0.1);
            color: var(--accent-light);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px var(--accent-glow);
        }

        .btn-danger {
            background: linear-gradient(135deg, #FF4A4A, #FF7E7E);
            color: #fff;
        }

        .btn-danger:hover {
            box-shadow: 0 5px 15px var(--danger-glow);
        }

        .btn-secondary {
            background: var(--bg-tertiary);
            color: var(--text-light);
            border: 1px solid var(--glass-border);
        }

        .btn-secondary:hover {
            background: var(--bg-secondary);
            color: #fff;
        }

        .login-error {
            background: rgba(255, 74, 74, 0.1);
            border: 1px solid var(--danger);
            color: var(--danger);
            padding: 12px;
            border-radius: 12px;
            font-size: 14px;
            margin-bottom: 20px;
            display: none;
        }

        /* Dashboard Layout */
        .dashboard {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 280px;
            background: var(--bg-secondary);
            border-right: 1px solid var(--glass-border);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
            z-index: 100;
            overflow-y: auto;
        }

        .sidebar-brand {
            font-size: 24px;
            font-weight: 800;
            margin-bottom: 40px;
            font-family: 'Outfit', sans-serif;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
            flex-grow: 1;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 14px 20px;
            color: var(--text-main);
            border-radius: 12px;
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .menu-item a:hover, .menu-item.active a {
            background: rgba(102, 252, 241, 0.08);
            color: var(--accent-light);
            border-left: 3px solid var(--accent-light);
        }

        .sidebar-footer {
            margin-top: 30px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .main-content {
            margin-left: 280px;
            flex-grow: 1;
            padding: 40px 50px;
            background-color: var(--bg-main);
            min-height: 100vh;
        }

        .top-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
            border-bottom: 1px solid var(--glass-border);
            padding-bottom: 20px;
        }

        .top-bar h2 {
            font-size: 28px;
        }

        .actions-group {
            display: flex;
            gap: 15px;
        }

        .dashboard-section {
            display: none;
            animation: fadeIn 0.4s ease forwards;
        }

        .dashboard-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            border-radius: 20px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 15px;
        }

        .card-header h3 {
            font-size: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 25px;
        }

        .tag-editor {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            background: var(--bg-tertiary);
            border: 1px solid var(--glass-border);
            border-radius: 12px;
            padding: 12px;
            min-height: 56px;
            align-items: center;
        }

        .tag-chip {
            background: rgba(102, 252, 241, 0.12);
            color: var(--accent-light);
            border: 1px solid rgba(102, 252, 241, 0.25);
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .tag-chip i {
            cursor: pointer;
            transition: color 0.2s;
        }

        .tag-chip i:hover {
            color: var(--danger);
        }

        .tag-input-wrapper {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .tag-input-wrapper .form-control {
            padding-left: 15px;
        }

        /* Sortable List Styling */
        .list-item-card {
            background: var(--bg-tertiary);
            border: 1px solid var(--glass-border);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 20px;
            position: relative;
            transition: var(--transition);
        }

        .list-item-card:hover {
            border-color: rgba(102, 252, 241, 0.25);
        }

        .list-item-actions {
            display: flex;
            gap: 8px;
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .action-icon {
            width: 34px;
            height: 34px;
            border-radius: 8px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            color: var(--text-main);
            cursor: pointer;
            transition: var(--transition);
        }

        .action-icon:hover {
            background: rgba(102, 252, 241, 0.15);
            color: var(--accent-light);
            border-color: var(--accent-light);
        }

        .action-icon.delete:hover {
            background: rgba(255, 74, 74, 0.15);
            color: var(--danger);
            border-color: var(--danger);
        }

        .list-item-fields {
            margin-top: 15px;
        }

        /* Toast Notifications */
        .toast {
            position: fixed;
            bottom: 30px;
            right: -400px;
            background: var(--bg-secondary);
            border: 1px solid var(--glass-border);
            border-left: 6px solid var(--accent-light);
            border-radius: 12px;
            padding: 16px 24px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            display: flex;
            align-items: center;
            gap: 15px;
            z-index: 1000;
            transition: right 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            color: #fff;
        }

        .toast.show {
            right: 30px;
        }

        .toast.success {
            border-left-color: var(--success);
        }

        .toast.danger {
            border-left-color: var(--danger);
        }

        .toast i {
            font-size: 20px;
        }

        /* Modal custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: var(--bg-main);
        }
        ::-webkit-scrollbar-thumb {
            background: var(--bg-secondary);
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: var(--accent);
        }

        @media (max-width: 992px) {
            .sidebar {
                width: 70px;
                padding: 20px 10px;
                align-items: center;
            }
            .sidebar-brand span, .menu-item-text, .sidebar-footer button span {
                display: none;
            }
            .sidebar-brand i {
                font-size: 24px;
            }
            .main-content {
                margin-left: 70px;
                padding: 30px 20px;
            }
            .grid-2 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- Background Animated Shapes -->
    <div class="bg-shape shape-1"></div>
    <div class="bg-shape shape-2"></div>

    <?php if (!$is_logged_in): ?>
        <!-- Login UI -->
        <div class="login-container">
            <div class="login-card">
                <div class="login-logo">S<span class="highlight">K</span> ADMIN</div>
                <div class="login-subtitle">Authenticate to edit your portfolio website</div>
                
                <div class="login-error" id="loginError">Incorrect password! Please try again.</div>
                
                <form id="loginForm" onsubmit="handleLogin(event)">
                    <div class="form-group">
                        <label for="password">Admin Password</label>
                        <div class="input-group">
                            <i class="fa-solid fa-lock"></i>
                            <input type="password" id="password" class="form-control" placeholder="Enter password" required autofocus>
                        </div>
                    </div>
                    <button type="submit" class="btn">
                        <i class="fa-solid fa-right-to-bracket"></i> Login Dashboard
                    </button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <!-- Admin Dashboard UI -->
        <div class="dashboard">
            <!-- Sidebar -->
            <div class="sidebar">
                <div class="sidebar-brand">
                    <i class="fa-solid fa-sliders highlight"></i>
                    <span>S<span class="highlight">K</span> Admin</span>
                </div>
                
                <ul class="sidebar-menu">
                    <li class="menu-item active" data-target="profile-sec">
                        <a><i class="fa-solid fa-user"></i><span class="menu-item-text">Profile Info</span></a>
                    </li>
                    <li class="menu-item" data-target="skills-sec">
                        <a><i class="fa-solid fa-screwdriver-wrench"></i><span class="menu-item-text">Skills & Stats</span></a>
                    </li>
                    <li class="menu-item" data-target="experience-sec">
                        <a><i class="fa-solid fa-briefcase"></i><span class="menu-item-text">Experience</span></a>
                    </li>
                    <li class="menu-item" data-target="projects-sec">
                        <a><i class="fa-solid fa-folder-open"></i><span class="menu-item-text">Projects</span></a>
                    </li>
                    <li class="menu-item" data-target="education-sec">
                        <a><i class="fa-solid fa-graduation-cap"></i><span class="menu-item-text">Education</span></a>
                    </li>
                    <li class="menu-item" data-target="certifications-sec">
                        <a><i class="fa-solid fa-certificate"></i><span class="menu-item-text">Achievements</span></a>
                    </li>
                </ul>

                <div class="sidebar-footer">
                    <a href="/" target="_blank" class="btn btn-outline" style="text-decoration:none;">
                        <i class="fa-solid fa-eye"></i> <span>View Portfolio</span>
                    </a>
                    <button onclick="logout()" class="btn btn-danger">
                        <i class="fa-solid fa-right-from-bracket"></i> <span>Logout</span>
                    </button>
                </div>
            </div>

            <!-- Main Content Panel -->
            <div class="main-content">
                <div class="top-bar">
                    <h2 id="sectionTitle">Profile Info</h2>
                    <div class="actions-group">
                        <button onclick="downloadBackup()" class="btn btn-secondary" title="Download backup of data.json to commit to Git">
                            <i class="fa-solid fa-download"></i> Download JSON
                        </button>
                        <button onclick="saveAllChanges()" class="btn">
                            <i class="fa-solid fa-floppy-disk"></i> Save Changes
                        </button>
                    </div>
                </div>

                <div id="readOnlyWarning" class="card" style="display:none; border-color:var(--danger); background:rgba(255, 74, 74, 0.05); margin-bottom: 20px; padding: 20px;">
                    <h4 style="color:var(--danger); margin-bottom:8px;"><i class="fa-solid fa-triangle-exclamation"></i> Filesystem Read-Only Notice</h4>
                    <p style="font-size:14px;">The hosting environment is read-only (such as Vercel). Changes cannot be saved directly to the server. Please click <strong>Download JSON</strong>, save the file as <code>data.json</code> in your <code>api/</code> folder, and deploy it to your Git repository.</p>
                </div>

                <form id="portfolioForm" onsubmit="event.preventDefault();">
                    
                    <!-- Section: Profile -->
                    <div id="profile-sec" class="dashboard-section active">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-user highlight"></i> Basic Profile Details</h3>
                            </div>
                            <div class="grid-2">
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input type="text" id="prof-name" class="form-control" placeholder="Sahil Khan" required>
                                </div>
                                <div class="form-group">
                                    <label>Professional Title</label>
                                    <input type="text" id="prof-title" class="form-control" placeholder="Flutter Developer & Mobile Engineer" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>About Summary</label>
                                <textarea id="prof-about" class="form-control" placeholder="Describe yourself..."></textarea>
                            </div>
                            <div class="grid-2">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input type="email" id="prof-email" class="form-control" placeholder="hello@mastersahilkhan.com">
                                </div>
                                <div class="form-group">
                                    <label>LinkedIn Profile URL</label>
                                    <input type="url" id="prof-linkedin" class="form-control" placeholder="https://linkedin.com/in/username">
                                </div>
                            </div>
                            <div class="form-group">
                                <label>GitHub Profile URL</label>
                                <input type="url" id="prof-github" class="form-control" placeholder="https://github.com/username">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Skills & Stats -->
                    <div id="skills-sec" class="dashboard-section">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-screwdriver-wrench highlight"></i> Toolkit Skills</h3>
                            </div>
                            <div class="tag-editor" id="skillsTagContainer">
                                <!-- Tags rendered dynamically -->
                            </div>
                            <div class="tag-input-wrapper">
                                <input type="text" id="newSkillInput" class="form-control" placeholder="Type a skill and click Add (e.g. Flutter, Dart, Java)">
                                <button type="button" onclick="addSkill()" class="btn" style="width: auto; padding: 14px 25px;">Add</button>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-chart-simple highlight"></i> Portfolio Statistics (4 Cards)</h3>
                            </div>
                            <div class="grid-2" id="statsContainer">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Section: Experience -->
                    <div id="experience-sec" class="dashboard-section">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-briefcase highlight"></i> Professional Experience</h3>
                                <button type="button" onclick="addNewExperience()" class="btn" style="width: auto; padding: 8px 18px; font-size: 14px;">
                                    <i class="fa-solid fa-plus"></i> Add Job
                                </button>
                            </div>
                            <div id="experienceList">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Section: Projects -->
                    <div id="projects-sec" class="dashboard-section">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-folder-open highlight"></i> Featured Projects</h3>
                                <button type="button" onclick="addNewProject()" class="btn" style="width: auto; padding: 8px 18px; font-size: 14px;">
                                    <i class="fa-solid fa-plus"></i> Add Project
                                </button>
                            </div>
                            <div id="projectsList">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Section: Education -->
                    <div id="education-sec" class="dashboard-section">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-graduation-cap highlight"></i> Education</h3>
                                <button type="button" onclick="addNewEducation()" class="btn" style="width: auto; padding: 8px 18px; font-size: 14px;">
                                    <i class="fa-solid fa-plus"></i> Add Education
                                </button>
                            </div>
                            <div id="educationList">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>
                    </div>

                    <!-- Section: Achievements -->
                    <div id="certifications-sec" class="dashboard-section">
                        <div class="card">
                            <div class="card-header">
                                <h3><i class="fa-solid fa-certificate highlight"></i> Certifications & Professional Achievements</h3>
                                <button type="button" onclick="addNewCertification()" class="btn" style="width: auto; padding: 8px 18px; font-size: 14px;">
                                    <i class="fa-solid fa-plus"></i> Add Achievement
                                </button>
                            </div>
                            <div id="certificationsList">
                                <!-- Rendered dynamically -->
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Toast Messages -->
    <div class="toast" id="toast">
        <i class="fa-solid fa-circle-check" id="toastIcon"></i>
        <span id="toastMessage">Changes saved successfully!</span>
    </div>

    <script>
        // State
        const dataState = <?= json_encode($current_data) ?> || {
            name: "Sahil Khan",
            title: "Flutter Developer & Mobile Engineer",
            about: "",
            email: "",
            linkedin: "",
            github: "",
            skills: [],
            stats: [],
            experience: [],
            projects: [],
            education: [],
            certifications: []
        };

        // DOM Elements setup
        document.addEventListener('DOMContentLoaded', () => {
            const loginForm = document.getElementById('loginForm');
            if (!loginForm) {
                // User is logged in, initialize forms
                initMenu();
                loadProfile();
                loadSkills();
                loadStats();
                loadExperience();
                loadProjects();
                loadEducation();
                loadCertifications();
            }
        });

        // Toast Helper
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast');
            const icon = document.getElementById('toastIcon');
            const msg = document.getElementById('toastMessage');

            toast.className = `toast show ${type}`;
            msg.innerText = message;

            if (type === 'success') {
                icon.className = 'fa-solid fa-circle-check';
                icon.style.color = 'var(--success)';
            } else {
                icon.className = 'fa-solid fa-triangle-exclamation';
                icon.style.color = 'var(--danger)';
            }

            setTimeout(() => {
                toast.classList.remove('show');
            }, 4000);
        }

        // Login Handler
        function handleLogin(e) {
            e.preventDefault();
            const password = document.getElementById('password').value;
            const errorDiv = document.getElementById('loginError');

            fetch('/admin/api/login', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ password })
            })
            .then(res => {
                if (res.ok) {
                    window.location.reload();
                } else {
                    errorDiv.style.display = 'block';
                }
            })
            .catch(() => {
                errorDiv.style.display = 'block';
            });
        }

        function logout() {
            window.location.href = '/admin/api/logout';
        }

        // Navigation Sidebar
        function initMenu() {
            const menuItems = document.querySelectorAll('.sidebar-menu .menu-item');
            const sections = document.querySelectorAll('.dashboard-section');
            const titleEl = document.getElementById('sectionTitle');

            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    menuItems.forEach(i => i.classList.remove('active'));
                    sections.forEach(s => s.classList.remove('active'));

                    item.classList.add('active');
                    const targetId = item.getAttribute('data-target');
                    document.getElementById(targetId).classList.add('active');
                    
                    titleEl.innerText = item.querySelector('.menu-item-text').innerText;
                });
            });
        }

        // ------------------ Loading Data into Forms ------------------
        function loadProfile() {
            document.getElementById('prof-name').value = dataState.name || '';
            document.getElementById('prof-title').value = dataState.title || '';
            document.getElementById('prof-about').value = dataState.about || '';
            document.getElementById('prof-email').value = dataState.email || '';
            document.getElementById('prof-linkedin').value = dataState.linkedin || '';
            document.getElementById('prof-github').value = dataState.github || '';
        }

        function loadSkills() {
            const container = document.getElementById('skillsTagContainer');
            container.innerHTML = '';
            if (!dataState.skills) dataState.skills = [];
            
            dataState.skills.forEach((skill, index) => {
                const chip = document.createElement('div');
                chip.className = 'tag-chip';
                chip.innerHTML = `${skill} <i class="fa-solid fa-circle-xmark" onclick="removeSkill(${index})"></i>`;
                container.appendChild(chip);
            });
        }

        function addSkill() {
            const input = document.getElementById('newSkillInput');
            const val = input.value.trim();
            if (val) {
                dataState.skills.push(val);
                input.value = '';
                loadSkills();
            }
        }

        function removeSkill(index) {
            dataState.skills.splice(index, 1);
            loadSkills();
        }

        function loadStats() {
            const container = document.getElementById('statsContainer');
            container.innerHTML = '';
            if (!dataState.stats || dataState.stats.length === 0) {
                dataState.stats = [
                    { label: 'Years Experience', value: '3+' },
                    { label: 'Projects Completed', value: '15+' },
                    { label: 'DSA Questions', value: '120+' },
                    { label: 'Satisfaction Rate', value: '100%' }
                ];
            }

            dataState.stats.forEach((stat, index) => {
                const group = document.createElement('div');
                group.className = 'form-group card';
                group.style.marginBottom = '0';
                group.style.padding = '20px';
                group.innerHTML = `
                    <div style="font-weight:600; font-size:14px; color:var(--accent-light); margin-bottom:10px;">Stat Card ${index + 1}</div>
                    <div class="grid-2">
                        <div>
                            <label style="font-size:12px; margin-bottom:4px;">Label</label>
                            <input type="text" class="form-control" style="padding-left:15px;" value="${stat.label}" onchange="updateStat(${index}, 'label', this.value)">
                        </div>
                        <div>
                            <label style="font-size:12px; margin-bottom:4px;">Value</label>
                            <input type="text" class="form-control" style="padding-left:15px;" value="${stat.value}" onchange="updateStat(${index}, 'value', this.value)">
                        </div>
                    </div>
                `;
                container.appendChild(group);
            });
        }

        function updateStat(index, key, value) {
            dataState.stats[index][key] = value;
        }

        // ------------------ Experience Controller ------------------
        function loadExperience() {
            const container = document.getElementById('experienceList');
            container.innerHTML = '';
            if (!dataState.experience) dataState.experience = [];

            dataState.experience.forEach((job, index) => {
                const item = document.createElement('div');
                item.className = 'list-item-card';
                item.innerHTML = `
                    <div class="list-item-actions">
                        <div class="action-icon" onclick="moveItem('experience', ${index}, -1)" title="Move Up"><i class="fa-solid fa-arrow-up"></i></div>
                        <div class="action-icon" onclick="moveItem('experience', ${index}, 1)" title="Move Down"><i class="fa-solid fa-arrow-down"></i></div>
                        <div class="action-icon delete" onclick="deleteItem('experience', ${index})" title="Delete"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                    <h4 style="color:var(--accent-light); margin-bottom:15px;">#${index + 1} - ${job.company || 'New Company'}</h4>
                    <div class="list-item-fields">
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Role / Position</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${job.role || ''}" onchange="updateItem('experience', ${index}, 'role', this.value)">
                            </div>
                            <div class="form-group">
                                <label>Company Name</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${job.company || ''}" onchange="updateItem('experience', ${index}, 'company', this.value)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Period (e.g. Apr 2022 – Jan 2025)</label>
                            <input type="text" class="form-control" style="padding-left:15px;" value="${job.period || ''}" onchange="updateItem('experience', ${index}, 'period', this.value)">
                        </div>
                        <div class="form-group">
                            <label>Responsibilities & Description</label>
                            <textarea class="form-control" style="padding-left:15px;" onchange="updateItem('experience', ${index}, 'description', this.value)">${job.description || ''}</textarea>
                        </div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addNewExperience() {
            if (!dataState.experience) dataState.experience = [];
            dataState.experience.unshift({
                role: '',
                company: '',
                period: '',
                description: ''
            });
            loadExperience();
            showToast('New Job Experience card added to top.');
        }

        // ------------------ Projects Controller ------------------
        function loadProjects() {
            const container = document.getElementById('projectsList');
            container.innerHTML = '';
            if (!dataState.projects) dataState.projects = [];

            dataState.projects.forEach((proj, index) => {
                const tags = proj.tags ? proj.tags.join(', ') : '';
                const item = document.createElement('div');
                item.className = 'list-item-card';
                item.innerHTML = `
                    <div class="list-item-actions">
                        <div class="action-icon" onclick="moveItem('projects', ${index}, -1)" title="Move Up"><i class="fa-solid fa-arrow-up"></i></div>
                        <div class="action-icon" onclick="moveItem('projects', ${index}, 1)" title="Move Down"><i class="fa-solid fa-arrow-down"></i></div>
                        <div class="action-icon delete" onclick="deleteItem('projects', ${index})" title="Delete"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                    <h4 style="color:var(--accent-light); margin-bottom:15px;">#${index + 1} - ${proj.title || 'New Project'}</h4>
                    <div class="list-item-fields">
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Project Title</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${proj.title || ''}" onchange="updateItem('projects', ${index}, 'title', this.value)">
                            </div>
                            <div class="form-group">
                                <label>FontAwesome Icon Class (e.g. fa-solid fa-store)</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${proj.icon || 'fa-solid fa-briefcase'}" onchange="updateItem('projects', ${index}, 'icon', this.value)">
                            </div>
                        </div>
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Tags / Technologies (comma separated)</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${tags}" onchange="updateProjectTags(${index}, this.value)">
                            </div>
                            <div class="form-group">
                                <label>Project Link / Play Store Link</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${proj.link || '#'}" onchange="updateItem('projects', ${index}, 'link', this.value)">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Project Description</label>
                            <textarea class="form-control" style="padding-left:15px;" onchange="updateItem('projects', ${index}, 'description', this.value)">${proj.description || ''}</textarea>
                        </div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addNewProject() {
            if (!dataState.projects) dataState.projects = [];
            dataState.projects.unshift({
                title: '',
                description: '',
                tags: [],
                icon: 'fa-solid fa-briefcase',
                link: '#'
            });
            loadProjects();
            showToast('New Project card added to top.');
        }

        function updateProjectTags(index, value) {
            dataState.projects[index].tags = value.split(',').map(t => t.trim()).filter(t => t.length > 0);
        }

        // ------------------ Education Controller ------------------
        function loadEducation() {
            const container = document.getElementById('educationList');
            container.innerHTML = '';
            if (!dataState.education) dataState.education = [];

            dataState.education.forEach((edu, index) => {
                const item = document.createElement('div');
                item.className = 'list-item-card';
                item.innerHTML = `
                    <div class="list-item-actions">
                        <div class="action-icon" onclick="moveItem('education', ${index}, -1)" title="Move Up"><i class="fa-solid fa-arrow-up"></i></div>
                        <div class="action-icon" onclick="moveItem('education', ${index}, 1)" title="Move Down"><i class="fa-solid fa-arrow-down"></i></div>
                        <div class="action-icon delete" onclick="deleteItem('education', ${index})" title="Delete"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                    <h4 style="color:var(--accent-light); margin-bottom:15px;">#${index + 1} - ${edu.degree || 'New Education'}</h4>
                    <div class="list-item-fields">
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Degree / Qualification</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${edu.degree || ''}" onchange="updateItem('education', ${index}, 'degree', this.value)">
                            </div>
                            <div class="form-group">
                                <label>University / School / Institution</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${edu.institution || ''}" onchange="updateItem('education', ${index}, 'institution', this.value)">
                            </div>
                        </div>
                        <div class="grid-2">
                            <div class="form-group">
                                <label>Period (e.g. July 2022 – July 2024)</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${edu.period || ''}" onchange="updateItem('education', ${index}, 'period', this.value)">
                            </div>
                            <div class="form-group">
                                <label>Grade / Percentage / Score (e.g. Percentage: 83%)</label>
                                <input type="text" class="form-control" style="padding-left:15px;" value="${edu.grade || ''}" onchange="updateItem('education', ${index}, 'grade', this.value)">
                            </div>
                        </div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addNewEducation() {
            if (!dataState.education) dataState.education = [];
            dataState.education.unshift({
                degree: '',
                institution: '',
                period: '',
                grade: ''
            });
            loadEducation();
            showToast('New Education card added to top.');
        }

        // ------------------ Achievements / Certifications Controller ------------------
        function loadCertifications() {
            const container = document.getElementById('certificationsList');
            container.innerHTML = '';
            if (!dataState.certifications) dataState.certifications = [];

            dataState.certifications.forEach((cert, index) => {
                const item = document.createElement('div');
                item.className = 'list-item-card';
                item.innerHTML = `
                    <div class="list-item-actions">
                        <div class="action-icon" onclick="moveItem('certifications', ${index}, -1)" title="Move Up"><i class="fa-solid fa-arrow-up"></i></div>
                        <div class="action-icon" onclick="moveItem('certifications', ${index}, 1)" title="Move Down"><i class="fa-solid fa-arrow-down"></i></div>
                        <div class="action-icon delete" onclick="deleteItem('certifications', ${index})" title="Delete"><i class="fa-solid fa-trash-can"></i></div>
                    </div>
                    <h4 style="color:var(--accent-light); margin-bottom:15px;">#${index + 1} - ${cert.title || 'New Achievement'}</h4>
                    <div class="list-item-fields">
                        <div class="form-group">
                            <label>Title / Certification Name</label>
                            <input type="text" class="form-control" style="padding-left:15px;" value="${cert.title || ''}" onchange="updateItem('certifications', ${index}, 'title', this.value)">
                        </div>
                        <div class="form-group">
                            <label>Description / Details</label>
                            <textarea class="form-control" style="padding-left:15px;" onchange="updateItem('certifications', ${index}, 'description', this.value)">${cert.description || ''}</textarea>
                        </div>
                    </div>
                `;
                container.appendChild(item);
            });
        }

        function addNewCertification() {
            if (!dataState.certifications) dataState.certifications = [];
            dataState.certifications.unshift({
                title: '',
                description: ''
            });
            loadCertifications();
            showToast('New Achievement card added to top.');
        }

        // ------------------ Generic List Actions ------------------
        function updateItem(listKey, index, field, value) {
            dataState[listKey][index][field] = value;
        }

        function deleteItem(listKey, index) {
            if (confirm('Are you sure you want to delete this card?')) {
                dataState[listKey].splice(index, 1);
                
                // Re-render
                if (listKey === 'experience') loadExperience();
                else if (listKey === 'projects') loadProjects();
                else if (listKey === 'education') loadEducation();
                else if (listKey === 'certifications') loadCertifications();
                
                showToast('Card deleted.');
            }
        }

        function moveItem(listKey, index, direction) {
            const list = dataState[listKey];
            const targetIndex = index + direction;
            
            if (targetIndex >= 0 && targetIndex < list.length) {
                // Swap items
                const temp = list[index];
                list[index] = list[targetIndex];
                list[targetIndex] = temp;
                
                // Re-render
                if (listKey === 'experience') loadExperience();
                else if (listKey === 'projects') loadProjects();
                else if (listKey === 'education') loadEducation();
                else if (listKey === 'certifications') loadCertifications();
            }
        }

        // ------------------ Save / Backup Handlers ------------------
        function getUpdatedData() {
            return {
                name: document.getElementById('prof-name').value.trim(),
                title: document.getElementById('prof-title').value.trim(),
                about: document.getElementById('prof-about').value.trim(),
                email: document.getElementById('prof-email').value.trim(),
                linkedin: document.getElementById('prof-linkedin').value.trim(),
                github: document.getElementById('prof-github').value.trim(),
                skills: dataState.skills,
                stats: dataState.stats,
                experience: dataState.experience,
                projects: dataState.projects,
                education: dataState.education,
                certifications: dataState.certifications
            };
        }

        function saveAllChanges() {
            const dataToSave = getUpdatedData();
            document.getElementById('readOnlyWarning').style.display = 'none';

            fetch('/admin/api/save', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(dataToSave)
            })
            .then(res => res.json())
            .then(res => {
                if (res.success) {
                    showToast('All changes saved to data.json successfully!');
                } else {
                    if (res.readOnly) {
                        document.getElementById('readOnlyWarning').style.display = 'block';
                        showToast('Read-only environment. Click Download JSON instead.', 'danger');
                    } else {
                        showToast('Error: ' + res.message, 'danger');
                    }
                }
            })
            .catch(err => {
                showToast('Failed to save changes. Please try downloading the JSON backup.', 'danger');
                console.error(err);
            });
        }

        function downloadBackup() {
            // Check if there is data
            const dataToSave = getUpdatedData();
            const dataStr = "data:text/json;charset=utf-8," + encodeURIComponent(JSON.stringify(dataToSave, null, 2));
            const downloadAnchor = document.createElement('a');
            downloadAnchor.setAttribute("href", dataStr);
            downloadAnchor.setAttribute("download", "data.json");
            document.body.appendChild(downloadAnchor);
            downloadAnchor.click();
            downloadAnchor.remove();
            showToast('JSON backup file generated and download started!');
        }
    </script>
</body>
</html>
