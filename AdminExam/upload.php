<?php
if (isset($_POST['submit'])) {
    $target_dir = "uploads/"; 
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    
    
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg" || $imageFileType == "gif") {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            header("location:addDetails.php");
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Invalid image format. Please upload a JPG, JPEG, PNG, or GIF file.";
    }
}
?>
