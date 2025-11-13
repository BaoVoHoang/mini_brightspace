<?php
session_start();
include('../config.php');
include('../includes/header.php');
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'admin') {
    header("Location: ../auth/login.php");
    exit();
}

// Add user
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_user'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $conn->query("INSERT INTO users (name, email, password, role)
                  VALUES ('$name', '$email', '$password', '$role')");
}

// Delete user
if (isset($_GET['delete'])) {
    $user_id = $_GET['delete'];
    $conn->query("DELETE FROM users WHERE user_id='$user_id'");
}

$users = $conn->query("SELECT * FROM users ORDER BY role, name");

echo "<h2>Manage Users</h2>";
echo "<form method='POST'>
        <input type='text' name='name' placeholder='Name' required>
        <input type='email' name='email' placeholder='Email' required>
        <input type='text' name='password' placeholder='Password' required>
        <select name='role'>
            <option value='student'>Student</option>
            <option value='teacher'>Teacher</option>
            <option value='admin'>Admin</option>
        </select>
        <button type='submit' name='add_user'>Add User</button>
      </form><br>";

echo "<table border='1' cellpadding='8'>";
echo "<tr><th>ID</th><th>Name</th><th>Email</th><th>Role</th><th>Action</th></tr>";
while ($u = $users->fetch_assoc()) {
    echo "<tr>
            <td>{$u['user_id']}</td>
            <td>{$u['name']}</td>
            <td>{$u['email']}</td>
            <td>{$u['role']}</td>
            <td><a href='?delete={$u['user_id']}'>🗑️ Delete</a></td>
          </tr>";
}
echo "</table>";
?>
