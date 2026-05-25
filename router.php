<?php
// router.php
// Serve static assets directly
if (preg_match('/\.(?:png|jpg|jpeg|gif|css|js|ico)$/', $_SERVER["REQUEST_URI"])) {
    return false;
}
// Route everything else to api/index.php
include __DIR__ . '/api/index.php';
?>
