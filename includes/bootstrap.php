<?php
if (session_status() === PHP_SESSION_NONE) session_start();

define('BASE_DIR', dirname(__DIR__));
define('BASE_URL', '/mini_brightspace'); // adjust if your folder name differs

require_once BASE_DIR . '/config.php'; // database connection

// Global user info (for header/navbar)
$logged_in = isset($_SESSION['user_id']);
$name = $logged_in ? $_SESSION['name'] : null;
$role = $logged_in ? $_SESSION['role'] : null;

// Helper to render views
function render($view, $data = []) {
    extract($data);
    include BASE_DIR . '/includes/header.php';
    include BASE_DIR . '/views/' . $view . '.php';
    include BASE_DIR . '/includes/footer.php';
}
