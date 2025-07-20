<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            header('Location: dashboard.php');
            exit();
        } else {
            $error = "Invalid credentials.";
        }
    } else {
        $error = "No user found.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orb. - Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body style="background: url('orb/orb-bg.jpg') no-repeat center center fixed; background-size: cover;">
    <div class="logo">
        <img src="orb/ORB.jpg" alt="Orb Logo" width="120">
    </div>
    <h2>Create the life you crave.</h2>
    <form method="POST">
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>