<?php
session_start();
include "connect.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullName = $_POST['fullName'];
    $regNo = $_POST['regNo'];
    $nic = $_POST['nic'];
    $email = $_POST['email'];
    $contactNo = $_POST['contactNo'];
    $address = $_POST['address'];
    $degreeProgram = $_POST['degreeProgram'];
    $batchNo = $_POST['batchNo'];
    $currentLevel = $_POST['currentLevel'];
    $gender = $_POST['gender'];
    $admissionDate = $_POST['admissionDate'];
    $indexNo = $_POST['indexNo'];

    // Handle profile picture upload
    $targetDir = "uploads/";
    $fileName = $regNo . "_" . basename($_FILES['profile_picture']['name']);
    $targetFilePath = $targetDir . $fileName;
    $fileType = strtolower(pathinfo($targetFilePath, PATHINFO_EXTENSION));

    $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
    if (in_array($fileType, $allowedTypes)) {
        if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $targetFilePath)) {
            // Insert student data into the database
            $query = "INSERT INTO students (fullName, regNo, nic, email, contactNo, address, degreeProgram, batchNo, 
                      currentLevel, gender, admissionDate, indexNo, profile_picture) 
                      VALUES ('$fullName', '$regNo', '$nic', '$email', '$contactNo', '$address', '$degreeProgram', 
                      '$batchNo', '$currentLevel', '$gender', '$admissionDate', '$indexNo', '$targetFilePath')";

            if (mysqli_query($con, $query)) {
                echo "Registration successful!";
                header("Location: dashboard.php");
            } else {
                echo "Error: " . mysqli_error($con);
            }
        } else {
            echo "File upload failed.";
        }
    } else {
        echo "Only JPG, JPEG, PNG, and GIF files are allowed.";
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .registration-form {
            width: 400px;
            margin: 50px auto;
            background-color: white;
            padding: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, 
        .form-group select {
            width: 100%;
            padding: 8px;
            margin: 5px 0;
            box-sizing: border-box;
            border-radius: 4px;
            border: 1px solid #ccc;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            width: 100%;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #028a5e;
        }
    </style>
</head>
<body>

<div class="registration-form">
    <h2>Student Registration</h2>
    <form action="register_student.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="fullName">Full Name</label>
            <input type="text" name="fullName" required>
        </div>

        <div class="form-group">
            <label for="regNo">Registration No</label>
            <input type="text" name="regNo" placeholder="e.g: 2021/CSC/006" required 
       pattern="^[0-9]{4}/[A-Za-z]{3}/[0-9]{3}$" 
       title="Format: 2021/CSC/006">


        <div class="form-group">
            <label for="nic">NIC</label>
            <input type="text" name="nic" required pattern="[0-9]{9}[VvXx]">
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="contactNo">Contact Number</label>
            <input type="tel" name="contactNo" required pattern="[0-9]{10}" placeholder="e.g., 0771234567">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" name="address" required>
        </div>

        <div class="form-group">
            <label for="degreeProgram">Degree Program</label>
            <select name="degreeProgram" required>
                <option value="Direct Intake">Direct Intake</option>
                <option value="Indirect Intake">Indirect Intake</option>
            </select>
        </div>

        <div class="form-group">
            <label for="batchNo">Batch No</label>
            <input type="number" name="batchNo" required>
        </div>

        <div class="form-group">
            <label for="currentLevel">Current Level</label>
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
            
        </div>

        <div class="form-group">
            <label for="gender">Gender</label>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
        </div>

        <div class="form-group">
            <label for="admissionDate">Admission Date</label>
            <input type="date" name="admissionDate" required>
        </div>

        <div class="form-group">
            <label for="indexNo">Index No</label>
            <input type="text" name="indexNo" required>
        </div>

        <div class="form-group">
            <label for="profile_picture">Profile Picture</label>
            <input type="file" name="profile_picture" accept="image/*" required>
        </div>

        <button type="submit" class="btn">Register</button>
    </form>
</div>

</body>
</html>
