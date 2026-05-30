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

// Fallbacks
$name = isset($data['name']) ? $data['name'] : "Sahil Khan";
$title = isset($data['title']) ? $data['title'] : "Flutter Developer & Mobile Engineer";
$about = isset($data['about']) ? $data['about'] : "I am a passionate Flutter Developer and Software Engineer crafting high-performance, cross-platform mobile applications.";
$email = isset($data['email']) ? $data['email'] : "sahilkh3014@gmail.com";
$phone = isset($data['phone']) ? $data['phone'] : "+91 8739093014";
$linkedin = isset($data['linkedin']) ? $data['linkedin'] : "https://www.linkedin.com/in/mastersahilkhan/";
$github = isset($data['github']) ? $data['github'] : "https://github.com/khsahil2019";
$skills = isset($data['skills']) ? $data['skills'] : ["Flutter", "Dart", "GetX", "PHP", "MySQL", "REST APIs"];
$experience = isset($data['experience']) ? $data['experience'] : [];
$education = isset($data['education']) ? $data['education'] : [];
$certifications = isset($data['certifications']) ? $data['certifications'] : [];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($name) ?> - Professional Resume</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700;800&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1F2833;
            --accent: #45A29E;
            --accent-light: #66FCF1;
            --text-dark: #2B2D42;
            --text-muted: #6C757D;
            --bg-light: #F8F9FA;
            --border-color: #E9ECEF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
            line-height: 1.5;
            padding: 40px 20px;
        }

        .resume-container {
            max-width: 850px;
            margin: 0 auto;
            background: #fff;
            padding: 50px;
            border-radius: 8px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        /* Floating action buttons */
        .actions-bar {
            max-width: 850px;
            margin: 0 auto 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--primary);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-family: 'Outfit', sans-serif;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--primary);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: #fff;
        }

        /* Resume Styling */
        header {
            border-bottom: 2px solid var(--accent);
            padding-bottom: 25px;
            margin-bottom: 30px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .header-left h1 {
            font-family: 'Outfit', sans-serif;
            font-size: 38px;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 5px;
            letter-spacing: -0.5px;
        }

        .header-left h2 {
            font-family: 'Outfit', sans-serif;
            font-size: 20px;
            font-weight: 500;
            color: var(--accent);
            letter-spacing: 0.5px;
        }

        .header-right {
            text-align: right;
            font-size: 14px;
            color: var(--text-dark);
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .header-right a {
            color: var(--text-dark);
            text-decoration: none;
        }

        .header-right a:hover {
            color: var(--accent);
        }

        .header-right i {
            width: 18px;
            color: var(--accent);
            text-align: center;
            margin-right: 6px;
        }

        .section {
            margin-bottom: 30px;
        }

        .section-title {
            font-family: 'Outfit', sans-serif;
            font-size: 18px;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .section-title::after {
            content: '';
            flex-grow: 1;
            height: 1px;
            background-color: var(--border-color);
        }

        .summary p {
            color: var(--text-muted);
            font-size: 14.5px;
            line-height: 1.6;
        }

        .experience-item, .education-item {
            margin-bottom: 20px;
        }

        .experience-item:last-child, .education-item:last-child {
            margin-bottom: 0;
        }

        .item-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 6px;
        }

        .item-title {
            font-family: 'Outfit', sans-serif;
            font-size: 16px;
            font-weight: 700;
            color: var(--primary);
        }

        .item-meta {
            font-size: 14px;
            color: var(--accent);
            font-weight: 600;
        }

        .item-period {
            font-size: 13.5px;
            color: var(--text-muted);
            font-weight: 500;
        }

        .item-desc {
            font-size: 14px;
            color: var(--text-muted);
            line-height: 1.6;
        }

        .skills-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .skill-tag {
            background-color: var(--bg-light);
            border: 1px solid var(--border-color);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 500;
            color: var(--primary);
        }

        .certifications-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .cert-item {
            font-size: 14px;
        }

        .cert-item strong {
            color: var(--primary);
        }

        .cert-item span {
            color: var(--text-muted);
            display: block;
            margin-top: 2px;
        }

        /* Print Media Styles */
        @media print {
            body {
                background-color: #fff;
                padding: 0;
                color: #000;
            }

            .resume-container {
                box-shadow: none;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }

            .btn {
                display: none !important;
            }
        }
    </style>
</head>
<body>

    <div class="actions-bar no-print">
        <a href="/" class="btn btn-outline"><i class="fa-solid fa-arrow-left"></i> Back to Portfolio</a>
        <button onclick="window.print()" class="btn"><i class="fa-solid fa-print"></i> Print / Save as PDF</button>
    </div>

    <div class="resume-container">
        <header>
            <div class="header-left">
                <h1><?= htmlspecialchars($name) ?></h1>
                <h2><?= htmlspecialchars($title) ?></h2>
            </div>
            <div class="header-right">
                <div><i class="fa-solid fa-envelope"></i> <a href="mailto:<?= htmlspecialchars($email) ?>"><?= htmlspecialchars($email) ?></a></div>
                <div><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($phone) ?></div>
                <div><i class="fa-brands fa-linkedin"></i> <a href="<?= htmlspecialchars($linkedin) ?>" target="_blank">linkedin.com/in/mastersahilkhan</a></div>
                <div><i class="fa-brands fa-github"></i> <a href="<?= htmlspecialchars($github) ?>" target="_blank">github.com/khsahil2019</a></div>
            </div>
        </header>

        <section class="section summary">
            <h3 class="section-title">Professional Summary</h3>
            <p><?= htmlspecialchars($about) ?></p>
        </section>

        <section class="section">
            <h3 class="section-title">Experience</h3>
            <?php foreach ($experience as $job): ?>
                <div class="experience-item">
                    <div class="item-header">
                        <div>
                            <span class="item-title"><?= htmlspecialchars($job['role']) ?></span>
                            <span class="item-meta"> | <?= htmlspecialchars($job['company']) ?></span>
                        </div>
                        <span class="item-period"><?= htmlspecialchars($job['period']) ?></span>
                    </div>
                    <div class="item-desc">
                        <?= htmlspecialchars($job['description']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="section">
            <h3 class="section-title">Skills</h3>
            <div class="skills-grid">
                <?php foreach ($skills as $skill): ?>
                    <span class="skill-tag"><?= htmlspecialchars($skill) ?></span>
                <?php endforeach; ?>
            </div>
        </section>

        <section class="section">
            <h3 class="section-title">Education</h3>
            <?php foreach ($education as $edu): ?>
                <div class="education-item">
                    <div class="item-header">
                        <div>
                            <span class="item-title"><?= htmlspecialchars($edu['degree']) ?></span>
                            <span class="item-meta"> | <?= htmlspecialchars($edu['institution']) ?></span>
                        </div>
                        <span class="item-period"><?= htmlspecialchars($edu['period']) ?></span>
                    </div>
                    <?php if (!empty($edu['grade'])): ?>
                        <div class="item-desc" style="font-weight: 500; color: var(--accent);">
                            <?= htmlspecialchars($edu['grade']) ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="section">
            <h3 class="section-title">Achievements & Certifications</h3>
            <ul class="certifications-list">
                <?php foreach ($certifications as $cert): ?>
                    <li class="cert-item">
                        <strong><?= htmlspecialchars($cert['title']) ?></strong>
                        <span><?= htmlspecialchars($cert['description']) ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </section>
    </div>

</body>
</html>
