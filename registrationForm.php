<?php
session_start();
include "connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $fullName = $_POST['fullName'];
    $regNo = $_POST['regNo'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    $currentLevel = $_POST['currentLevel'];
    $gender = $_POST['gender'];
    $admissionDate = $_POST['admissionDate'];
    $indexNo = $_POST['indexNo'];
    $faculty = $_POST['faculty'];
    $studyProgram = $_POST['studyProgram'];


    
    if (!empty($fullName) && !empty($regNo) && !empty($nic) && !empty($email) && 
    !empty($contactNo) && !empty($address) && !empty($password) && !empty($rePassword) && 
    !empty($currentLevel) && !empty($gender) && !empty($admissionDate) && 
    !empty($indexNo) && !empty($faculty) && !empty($studyProgram)) {
        // Password validation
        if ($password !== $rePassword) {
            // Display an alert using JavaScript
            echo "<script>
                    alert('Your Passwords do not match.');
                    window.location.href = 'registrationForm.php';
                  </script>";
            exit(); // Ensure no further code runs after the script
        }

    // Handle file upload
    // Handle file upload
$profile_picture = $_FILES['profile_picture'];
$targetDir = "uploads/";
$filename = preg_replace("/\s+/", "_", basename($profile_picture["name"])); // Sanitize file name
$targetFile = $targetDir . $filename;
$uploadOk = 1;

// Check if file is an image
$check = getimagesize($profile_picture["tmp_name"]);
if ($check === false) {
    die("File is not an image.");
}

// Save the uploaded file
if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true); // Create directory if it doesn't exist
}

if (move_uploaded_file($profile_picture["tmp_name"], $targetFile)) {
    
} else {
    if ($password !== $rePassword) {
        // Display an alert using JavaScript
        echo "<script>
                alert('Sorry, there was an error uploading your file.');
                window.location.href = 'registrationForm.php';
              </script>";
        exit(); // Ensure no further code runs after the script
    }
   
}


    
    $query = "INSERT INTO students (fullName, regNo, nic, email, contactNo, address, password, currentLevel, gender, admissionDate, indexNo, profile_picture, faculty, studyProgram) 
              VALUES ('$fullName', '$regNo', '$nic', '$email', '$contactNo', '$address', '$password', '$currentLevel', '$gender', '$admissionDate', '$indexNo', '$targetFile', '$faculty', '$studyProgram')";
    $result = mysqli_query($conn, $query);
    if ($result) {
        // Redirect to login page
        header("Location: login.php");
        exit(); // Ensure no further code is executed after redirect
    } else {
        echo "<script>alert('This is an alert message!');</script>";
    
    }
    

   
}

    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        form {
            width: 50%;
            margin: 0 auto;
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        input[type="file"] {
            margin-top: 10px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>

    <h2 style="text-align: center;">Student Registration Form</h2>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input type="text" name="fullName" placeholder="Enter your full name" required>

        <label for="regNo">Registration Number:</label>
        <input type="text" name="regNo" placeholder="Ex:2021CSC001/2021SP001" pattern="2021(CSC|SP)\d{3}" required>

        <label for="currentLevel">Current Level:</label>
        <select name="currentLevel" required>
            <option value="1S">1S</option>
            <option value="2S">2S</option>
            <option value="3S">3S</option>
            <option value="4S">4S</option>
            <option value="1G">1G</option>
            <option value="2G">2G</option>
            <option value="3G">3G</option>
            <option value="4G">4G</option>
        </select>

        <label for="indexNo">Index Number:</label>
        <input type="text" name="indexNo" placeholder="Ex:S12345" required>


        <label for="nic">NIC:</label>
        <input type="text" name="nic" placeholder="Enter your NIC" required>

        <label for="email">Email:</label>
        <input type="email" name="email" placeholder="Enter your email" required>

        <label for="contactNo">Contact Number:</label>
        <input type="text" name="contactNo" placeholder="Enter your contact number" required>

        <label for="address">Address:</label>
        <input type="text" name="address" placeholder="Enter your address" required>

        <label for="password">Password:</label>
        <input type="password" name="password" placeholder="Enter your password" required>

        <label for="rePassword">Re-enter Password:</label>
        <input type="password" name="rePassword" placeholder="Re-enter your password" required>

        <label for="faculty">Faculty:</label>
        <input type="text" name="faculty" placeholder="Enter your faculty" required>

        <label for="studyProgram">Study Program:</label>
        <select name="studyProgram" required>
            <option value="directIntake">Direct Intake</option>
            <option value="indirectIntake">Indirect Intake</option>
        </select>

        <label for="admissionDate">Admission Date:</label>
        <input type="date" name="admissionDate" required>
        

        <label for="gender">Gender:</label>
        <select name="gender" required>
            <option value="MALE">Male</option>
            <option value="FEMALE">Female</option>
        </select>

        
        <label for="profile_picture">Profile Picture:</label>
        <input type="file" name="profile_picture" accept="image/*" required>

        

        <input type="submit" value="Register">
    </form>
    

</body>

</html>

