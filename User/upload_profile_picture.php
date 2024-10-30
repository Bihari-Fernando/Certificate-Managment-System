<?php
session_start();
include "connect.php";

$regNo = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['profile_picture'])) {
    $targetDir = "uploads/"; // Folder to store uploaded images
    $fileName = $regNo . "_" . basename($_FILES['profile_picture']['name']); // Unique filename
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    // Validate image type
    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileType, $allowedTypes)) {
        // Upload file
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            // Update database with new profile picture path
            $query = "UPDATE students SET profile_picture = '$targetFilePath' WHERE regNo = '$regNo'";
            if (mysqli_query($con, $query)) {
                header("Location: dashboard.php"); // Redirect to dashboard
                exit();
            } else {
                echo "Database update failed.";
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
} else {
    echo "No file uploaded.";
}
?>
