<?php
session_start();
include "connect.php"; // Make sure to include your database connection

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Check if the email exists in the users table
    $query = "SELECT * FROM students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Generate a unique reset token
        $token = bin2hex(random_bytes(50));

        // Insert token into password_resets table
        $insertQuery = "INSERT INTO password_resets (email, token) VALUES ('$email', '$token')";
        mysqli_query($con, $insertQuery);

        // Send reset link to user's email
        $resetLink = "http://certificatemanagementsystem.com/reset_password.php?token=$token";
        $subject = "Password Reset Request";
        $message = "Hi, click the following link to reset your password: $resetLink";
        $headers = "From: no-reply@certifictemanagementsystem.com";

        if (mail($email, $subject, $message, $headers)) {
            $_SESSION['message'] = "Password reset link has been sent to your email.";
        } else {
            $_SESSION['message'] = "Failed to send email.";
        }
    } else {
        $_SESSION['message'] = "No user found with that email address.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <?php if (isset($_SESSION['message'])): ?>
        <p><?php echo $_SESSION['message']; unset($_SESSION['message']); ?></p>
    <?php endif; ?>
    <form action="" method="post">
        <label for="email">Enter your email address:</label>
        <input type="email" name="email" id="email" required>
        <button type="submit" name="submit">Send Reset Link</button>
    </form>
</div>

</body>
</html>
