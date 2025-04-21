<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'db.php';
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $admin = $result->fetch_assoc();
        $_SESSION['admin_id'] = $admin['id'];
        header("Location: admin_panel.php");
        exit();
    } else {
        echo "Invalid email or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>