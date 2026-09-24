<?php
// api/resume.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$dataPath = __DIR__ . '/data.json';
$data = [];
if (file_exists($dataPath)) {
    $data = json_decode(file_get_contents($dataPath), true);
}

// Data bindings with fallbacks
$name = isset($data['name']) ? $data['name'] : "SAHIL KHAN";
$location = isset($data['location']) ? $data['location'] : "Greater Noida, Uttar Pradesh";
$title = isset($data['title']) ? $data['title'] : "Flutter Developer";
$about = isset($data['about']) ? $data['about'] : "Results-driven Flutter Developer with 4+ years of hands-on experience designing, developing, and deploying high-performance mobile applications for Android and iOS platforms. Proven expertise in building scalable, data-driven solutions using Flutter, Dart, Node.js, PHP, Firebase, RESTful APIs, HTML and CSS. Demonstrated ability to integrate third-party APIs, optimize application performance, and implement responsive UI/UX designs. Adept at collaborating with cross-functional teams in Agile environments to deliver reliable digital products and business-focused solutions.";
$email = isset($data['email']) ? $data['email'] : "sahilkh3014@gmail.com";
$phone = isset($data['phone']) ? $data['phone'] : "+918739093014";
$linkedin = isset($data['linkedin']) ? $data['linkedin'] : "https://www.linkedin.com/in/mastersahilkhan/";
$github = isset($data['github']) ? $data['github'] : "https://github.com/khsahil2019";
$portfolio = isset($data['portfolio']) ? $data['portfolio'] : "/";
$experience = isset($data['experience']) ? $data['experience'] : [];
$projects = isset($data['projects']) ? $data['projects'] : [];
$education = isset($data['education']) ? $data['education'] : [];
$certifications = isset($data['certifications']) ? $data['certifications'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($name) ?> - Professional Resume</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Segoe+UI:wght@300;400;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-navy: #1f3a5f;
            --accent-link: #0b5394;
            --text-dark: #1e1e1e;
            --text-muted: #3a3a3a;
            --border-line: #1f3a5f;
            --bg-page: #f1f4f8;
            --card-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-dark);
            line-height: 1.42;
            font-size: 13.5px;
            padding: 30px 15px;
        }

        .actions-bar {
            max-width: 860px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 18px;
            background: var(--primary-navy);
            color: #ffffff;
            border: 1px solid var(--primary-navy);
            border-radius: 6px;
            font-weight: 600;
            font-size: 13.5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn:hover {
            background: #142a47;
            border-color: #142a47;
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: #fff;
            color: var(--primary-navy);
            border: 1px solid #c8d1db;
        }

        .btn-outline:hover {
            background: var(--primary-navy);
            border-color: var(--primary-navy);
            color: #fff;
        }

        .resume-sheet {
            max-width: 860px;
            margin: 0 auto;
            background: #ffffff;
            padding: 44px 52px;
            box-shadow: var(--card-shadow);
            border-radius: 4px;
        }

        /* Header */
        .resume-header {
            text-align: center;
            margin-bottom: 16px;
        }

        .resume-name {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1.5px;
            color: var(--primary-navy);
            margin-bottom: 4px;
            text-transform: uppercase;
        }

        .resume-location {
            font-size: 13px;
            color: #555555;
            margin-bottom: 6px;
            font-weight: 500;
        }

        .resume-contacts {
            font-size: 13px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
            padding-bottom: 12px;
            border-bottom: 2.5px solid var(--border-line);
        }

        .resume-contacts a {
            color: var(--accent-link);
            text-decoration: underline;
            text-underline-offset: 2.5px;
        }

        .resume-contacts span.sep {
            color: #888888;
        }

        /* Section Headings with enhanced margins */
        .section-header {
            font-size: 14.5px;
            font-weight: 700;
            color: var(--primary-navy);
            text-transform: uppercase;
            letter-spacing: 0.8px;
            padding-bottom: 4px;
            margin-top: 18px;
            margin-bottom: 10px;
            border-bottom: 1.5px solid var(--border-line);
        }

        .section-content {
            font-size: 13px;
            color: var(--text-dark);
        }

        .summary-text {
            text-align: justify;
            line-height: 1.45;
            color: #262626;
        }

        /* Bullet lists */
        ul.bullet-list {
            list-style: none;
            padding-left: 0;
            margin: 3px 0 8px 0;
        }

        ul.bullet-list li {
            position: relative;
            padding-left: 16px;
            margin-bottom: 3.5px;
            line-height: 1.4;
            color: #242424;
            text-align: justify;
        }

        ul.bullet-list li::before {
            content: "•";
            position: absolute;
            left: 2px;
            top: -0.5px;
            color: #242424;
            font-size: 13px;
            font-weight: bold;
        }

        /* Subheadings */
        .sub-header-title {
            font-weight: 700;
            color: #1a1a1a;
            margin-top: 8px;
            margin-bottom: 3px;
        }

        .exp-entry, .proj-entry, .edu-entry {
            margin-bottom: 11px;
        }

        .exp-entry:last-child, .proj-entry:last-child, .edu-entry:last-child {
            margin-bottom: 0;
        }

        .entry-header {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 2px;
        }

        .company-role {
            font-size: 13.5px;
            font-weight: 700;
            color: var(--primary-navy);
        }

        .company-role .role-title {
            font-weight: 600;
            color: #2b2b2b;
        }

        .date-range {
            font-size: 12.5px;
            font-weight: 500;
            color: #444;
            white-space: nowrap;
        }

        .proj-title-row {
            font-size: 13.5px;
            font-weight: 700;
            color: #111;
            margin-bottom: 2px;
        }

        .proj-title-row .proj-tech {
            font-weight: normal;
            font-style: italic;
            color: #444;
        }

        .proj-title-row a {
            color: var(--accent-link);
            text-decoration: underline;
            margin-left: 6px;
            font-weight: 500;
            font-style: normal;
        }

        .edu-inst {
            font-style: italic;
            color: #333;
            margin-top: 1px;
        }

        .cert-item {
            margin-bottom: 7px;
            line-height: 1.4;
        }

        .check-sym {
            font-weight: bold;
            color: var(--primary-navy);
            margin-right: 5px;
        }

        /* Page break divider for accurate 2-page print layout */
        .page-break {
            break-after: page;
            page-break-after: always;
        }

        @page {
            size: A4 portrait;
            margin: 8mm 10mm;
        }

        @media print {
            body {
                background: #fff;
                padding: 0;
                color: #000;
                font-size: 9.3pt;
                line-height: 1.28;
            }

            .no-print {
                display: none !important;
            }

            .resume-sheet {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }

            .resume-name {
                font-size: 17.5pt;
                margin-bottom: 1pt;
            }

            .resume-location {
                font-size: 8.5pt;
                margin-bottom: 2pt;
            }

            .resume-contacts {
                font-size: 8.5pt;
                padding-bottom: 4pt;
                margin-bottom: 2pt;
            }

            .section-header {
                font-size: 9.8pt;
                margin-top: 7pt;
                margin-bottom: 3pt;
                padding-bottom: 1.5pt;
            }

            .sub-header-title {
                margin-top: 3pt;
                margin-bottom: 1pt;
            }

            .section-content {
                font-size: 9.2pt;
            }

            .company-role, .proj-title-row {
                font-size: 9.4pt;
            }

            .date-range {
                font-size: 8.8pt;
            }

            .page-break {
                height: 0;
                margin: 0;
                padding: 0;
            }

            ul.bullet-list {
                margin: 1pt 0 2.5pt 0;
            }

            ul.bullet-list li {
                margin-bottom: 1.5pt;
                line-height: 1.25;
            }

            .exp-entry, .proj-entry, .edu-entry {
                margin-bottom: 4.5pt;
            }

            a {
                color: #0b5394 !important;
                text-decoration: underline !important;
            }
        }
    </style>
</head>
<body>

    <div class="actions-bar no-print">
        <a href="/" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Portfolio</a>
        <div style="display: flex; gap: 10px;">
            <a href="/assets/Sahil_Khan_Resume.pdf" download="Sahil_Khan_Resume.pdf" class="btn btn-outline"><i class="fa-solid fa-download"></i> Download PDF</a>
            <button onclick="window.print()" class="btn"><i class="fa-solid fa-print"></i> Print / Save as PDF</button>
        </div>
    </div>

    <div class="resume-sheet">
        <!-- ==================== PAGE 1 ==================== -->
        <header class="resume-header">
            <h1 class="resume-name"><?= htmlspecialchars($name) ?></h1>
            <div class="resume-location"><?= htmlspecialchars($location) ?></div>
            <div class="resume-contacts">
                <span><?= htmlspecialchars($phone) ?></span>
                <span class="sep">|</span>
                <a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a>
                <span class="sep">|</span>
                <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank">LinkedIn</a>
                <span class="sep">|</span>
                <a href="<?= htmlspecialchars($github) ?>" target="_blank">GitHub</a>
                <span class="sep">|</span>
                <a href="<?= htmlspecialchars($portfolio) ?>">Portfolio</a>
            </div>
        </header>

        <!-- Professional Summary -->
        <section>
            <h2 class="section-header">PROFESSIONAL SUMMARY</h2>
            <div class="section-content">
                <p class="summary-text"><?= htmlspecialchars($about) ?></p>
            </div>
        </section>

        <!-- Core Competencies -->
        <section>
            <h2 class="section-header">CORE COMPETENCIES</h2>
            <div class="section-content">
                <div class="sub-header-title">Mobile Development:</div>
                <ul class="bullet-list">
                    <li>Flutter &amp; Dart (Primary Expertise)</li>
                    <li>Cross-Platform Development (iOS/Android)</li>
                    <li>Flutter Version Control (FVC)</li>
                    <li>Mobile Sensor Integration</li>
                    <li>Performance Optimization &amp; Debugging</li>
                </ul>

                <div class="sub-header-title">Technical Proficiencies:</div>
                <ul class="bullet-list">
                    <li><strong>Programming:</strong> Dart, Java, C</li>
                    <li><strong>Mobile &amp; Frontend:</strong> Flutter Framework, Material Design, Responsive UI/UX</li>
                    <li><strong>APIs &amp; Cloud:</strong> Firebase, RESTful APIs, Third-Party Integration, Google Maps</li>
                    <li><strong>Tools:</strong> Git, GitHub, Android Studio, VS Code</li>
                    <li><strong>Methodologies:</strong> Agile Development, CI/CD</li>
                </ul>

                <div style="margin-top: 6px; line-height: 1.4;">
                    <strong>Additional Skills:</strong> Google Map Integration, Push Notifications, Payment Gateway Integration, State Management (GetX), Responsive Design, Data Structures &amp; Algorithms, Version Control &amp; Workflow Management
                </div>
            </div>
        </section>

        <!-- Professional Experience -->
        <section>
            <h2 class="section-header">PROFESSIONAL EXPERIENCE</h2>
            <div class="section-content">
                <!-- Job 1 -->
                <div class="exp-entry">
                    <div class="entry-header">
                        <span class="company-role">Vsafe Software Pvt Ltd <span style="font-weight: normal; color: #555;">|</span> <span class="role-title">Flutter Developer</span></span>
                        <span class="date-range">Mar 2026 – Present</span>
                    </div>
                    <ul class="bullet-list">
                        <li>Developing and maintaining cross-platform Flutter applications for Android and iOS with scalable architecture and responsive user interfaces.</li>
                        <li>Integrating REST APIs and backend services, resolving application issues, and improving performance across production releases.</li>
                        <li>Collaborating with backend, design, QA, and product teams throughout development, testing, deployment, and support.</li>
                    </ul>
                </div>

                <!-- Job 2 -->
                <div class="exp-entry">
                    <div class="entry-header">
                        <span class="company-role">Rafts and Rivers LLC <span style="font-weight: normal; color: #555;">|</span> <span class="role-title">Flutter Developer</span></span>
                        <span class="date-range">Apr 2022 – Feb 2026</span>
                    </div>
                    <ul class="bullet-list">
                        <li>Developed and maintained multiple production-ready Flutter applications across Android and iOS platforms.</li>
                        <li>Architected and implemented complex features including real-time API integrations, payment gateway functionality, and interactive UI components using GetX for efficient state management.</li>
                        <li>Optimized application performance by identifying bottlenecks and implementing caching and API-flow improvements.</li>
                        <li>Integrated third-party services including Google Maps API, Firebase authentication, push notifications, and backend-driven workflows.</li>
                        <li>Collaborated with cross-functional teams in Agile sprints to deliver projects on schedule while maintaining code quality standards.</li>
                    </ul>
                </div>

                <!-- Job 3 -->
                <div class="exp-entry">
                    <div class="entry-header">
                        <span class="company-role">Madhesiya Software Pvt Ltd <span style="font-weight: normal; color: #555;">|</span> <span class="role-title">Flutter Developer Intern</span></span>
                        <span class="date-range">Oct 2021 – Mar 2022</span>
                    </div>
                    <ul class="bullet-list">
                        <li>Completed 6-month intensive internship program focused on Flutter mobile application development and software engineering best practices.</li>
                        <li>Contributed to client-facing mobile applications across requirement analysis, development, API integration, testing, and deployment.</li>
                        <li>Gained hands-on experience with Dart programming, Flutter widgets, API integration, and responsive design principles.</li>
                        <li>Worked collaboratively with senior developers to resolve technical challenges and implement feature enhancements.</li>
                    </ul>
                </div>
            </div>
        </section>

        <div class="page-break"></div>

        <!-- ==================== PAGE 2 ==================== -->
        <!-- Key Projects & Achievements -->
        <section style="margin-top: 0;">
            <h2 class="section-header" style="margin-top: 0;">KEY PROJECTS &amp; ACHIEVEMENTS</h2>
            <div class="section-content">
                <!-- Project 1: Speaxa Teacher -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>Speaxa Teacher</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Dart, REST APIs</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.speaxa.teacher" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Developed a multi-role education platform supporting digital learning workflows for teachers, students, parents, and administrators.</li>
                        <li>Built Flutter mobile experiences integrated with REST APIs for real-time data synchronization.</li>
                        <li>Implemented class/session workflows, course &amp; batch management, attendance, assignments, and role-based dashboards.</li>
                    </ul>
                </div>

                <!-- Project 2: Human Heal -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>Human Heal</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Healthcare</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.human.health" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Developed a service-focused healthcare platform enabling users to explore trusted services, book appointments, track requests, and access patient records securely.</li>
                        <li>Designed intuitive appointment scheduling flows and user-data management with privacy and transparency principles.</li>
                    </ul>
                </div>

                <!-- Project 3: Crux -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>Crux</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Dart, GetX, Firebase</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.mycrux.app" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Engineered a comprehensive startup workspace platform integrating project management, team communication, and analytics tools.</li>
                        <li>Implemented GetX state management for seamless user interactions and integrated third-party APIs for real-time data retrieval.</li>
                    </ul>
                </div>

                <!-- Project 4: Quirix -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>Quirix (Sportify)</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Sports &amp; Gaming</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.sportifyCrux.app" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Created sports engagement application offering live tournament updates, interactive team challenges, and leaderboard participation.</li>
                        <li>Developed reward accumulation and in-app purchase functionality with responsive UI architecture across Android devices.</li>
                    </ul>
                </div>

                <!-- Project 5: Shrawan Care -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>Shrawan Care</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Healthcare</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.shrawan.care" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Developed a dedicated healthcare and elder care coordination platform providing assistive scheduling, routine monitoring, and caregiver support.</li>
                    </ul>
                </div>

                <!-- Project 6: KhanaDeDe -->
                <div class="proj-entry">
                    <div class="proj-title-row">
                        <span>KhanaDeDe</span> <span style="font-weight: normal; color: #555;">|</span> <span class="proj-tech">Flutter, Food Delivery</span> <span style="font-weight: normal; color: #555;">|</span> <a href="https://play.google.com/store/apps/details?id=com.khanadede" target="_blank">Play Store</a>
                    </div>
                    <ul class="bullet-list">
                        <li>Built an on-demand food ordering &amp; delivery application featuring dynamic restaurant menus, real-time cart calculations, and instant checkout.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Education -->
        <section>
            <h2 class="section-header">EDUCATION</h2>
            <div class="section-content">
                <div class="edu-entry">
                    <div class="entry-header">
                        <span class="company-role">Master of Computer Application (MCA)</span>
                        <span class="date-range">July 2022 – July 2024</span>
                    </div>
                    <div class="edu-inst">Galgotias University, Greater Noida <span style="font-style: normal; color: #222;">| Percentage: 83%</span></div>
                </div>

                <div class="edu-entry">
                    <div class="entry-header">
                        <span class="company-role">Bachelor of Computer Application (BCA)</span>
                        <span class="date-range">July 2019 – July 2022</span>
                    </div>
                    <div class="edu-inst">Integral University, Lucknow <span style="font-style: normal; color: #222;">| Percentage: 86.15%</span></div>
                </div>

                <div class="edu-entry">
                    <div class="entry-header">
                        <span class="company-role">Intermediate (Class 12)</span>
                        <span class="date-range">July 2018 – July 2019</span>
                    </div>
                    <div class="edu-inst">Lucknow Public School, Madhoganj <span style="font-style: normal; color: #222;">| Percentage: 78.40%</span></div>
                </div>

                <div class="edu-entry">
                    <div class="entry-header">
                        <span class="company-role">High School (Class 10)</span>
                        <span class="date-range">July 2016 – July 2017</span>
                    </div>
                    <div class="edu-inst">Lucknow Public School, Madhoganj <span style="font-style: normal; color: #222;">| Percentage: 87.83%</span></div>
                </div>
            </div>
        </section>

        <!-- Certifications & Professional Development -->
        <section>
            <h2 class="section-header">CERTIFICATIONS &amp; PROFESSIONAL DEVELOPMENT</h2>
            <div class="section-content">
                <div class="cert-item">
                    <span class="check-sym">✓</span><strong>Problem-Solving Excellence:</strong> Solved 50+ Java and front-end development tasks/questions across multiple coding platforms.
                </div>
                <div class="cert-item">
                    <span class="check-sym">✓</span><strong>Data Structures &amp; Algorithms Proficiency:</strong> Practiced daily DSA challenges and solved 70+ questions on GeeksforGeeks, LeetCode, and HackerRank.
                </div>
            </div>
        </section>
    </div>

</body>
</html>
