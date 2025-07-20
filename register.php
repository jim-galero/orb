<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";

    if ($conn->query($sql)) {
        header('Location: index.php');
        exit();
    } else {
        $error = "Registration failed.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Orb. - Register</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
      <div class="logo">
   <img src="orb/ORB.jpg" alt="Orb Logo" width="120">
</div>
    <h2>Create Account</h2>
    <form method="POST">
        <input type="text" name="name" placeholder="Full Name" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <button type="submit">Register</button>
    </form>
    <p>Already registered? <a href="index.php">Login here</a>.</p>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
</body>
</html>