<?php
require_once __DIR__ . '/includes/bootstrap.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: auth/login.php");
    exit();
}

render('dashboard_view', [
    'name' => $_SESSION['name'],
    'role' => $_SESSION['role']
]);
