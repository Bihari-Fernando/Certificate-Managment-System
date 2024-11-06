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
    $studyProgram = $_POST['studyProgram'];


    
    if (!empty($fullName) && !empty($regNo) && !empty($nic) && !empty($email) && 
    !empty($contactNo) && !empty($address) && !empty($password) && !empty($rePassword) && 
    !empty($currentLevel) && !empty($gender) && !empty($admissionDate) && 
    !empty($indexNo) && !empty($studyProgram)) {
        // Password validation
        if ($password !== $rePassword) {
            // Display an alert using JavaScript
            echo "<script>
                    alert('Your Passwords do not match.');
                    window.location.href = 'registrationForm.php';
                  </script>";
            exit(); // Ensure no further code runs after the script
        }

        $checkRegNoQuery = "SELECT * FROM students WHERE regNo = '$regNo'";
        $checkRegNoResult = mysqli_query($conn, $checkRegNoQuery);
        
        if (mysqli_num_rows($checkRegNoResult) > 0) {
            echo "<script>
                    alert('Registration number already exists. Please enter a unique registration number.');
                    window.location.href = 'registrationForm.php';
                  </script>";
            exit();
        }


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


    
    $query = "INSERT INTO students (fullName, regNo, nic, email, contactNo, address, password, currentLevel, gender, admissionDate, indexNo, profile_picture, studyProgram) 
              VALUES ('$fullName', '$regNo', '$nic', '$email', '$contactNo', '$address', '$password', '$currentLevel', '$gender', '$admissionDate', '$indexNo', '$targetFile', '$studyProgram')";
    $result = mysqli_query($conn, $query);
    if ($result) {

        header("Location: login.php");
        exit(); 
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
    <title>Student Registration Form</title>
    <style>
       
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

         body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background: #f4f4f9;
            margin: 0;
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        header {
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #004080;
            color: #fff;
            font-size: 1.8em;
            font-weight: 500;
            border-bottom: 3px solid #003366;
        }

       
        .form-container {
            width: 100%;
            max-width: 500px;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .form-header {
            text-align: center;
            margin-bottom: 25px;
        }

        .form-header h2 {
            font-size: 24px;
            color: #333;
            margin-bottom: 5px;
        }

        .form-header p {
            font-size: 14px;
            color: #666;
        }

        
        label {
            font-weight: bold;
            color: #555;
            display: block;
            margin: 15px 0 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="date"],
        select,
        input[type="file"] {
            width: 100%;
            padding: 10px 15px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            background-color: #fafafa;
            transition: background-color 0.3s ease;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="date"]:focus,
        select:focus {
            background-color: #eef;
            outline: none;
            border-color: #004080;
        }

       
        .submit-button {
            width: 100%;
            background-color: #004080;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .submit-button:hover {
            background-color: #003366;
        }

       
        footer {
            width: 100%;
            text-align: center;
            padding: 10px;
            background-color: #f4f4f9;
            color: #777;
            font-size: 14px;
            border-top: 1px solid #ddd;
        }

        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            input[type="text"],
            input[type="email"],
            input[type="password"],
            input[type="date"],
            select,
            input[type="file"],
            .submit-button {
                font-size: 14px;
                padding: 8px;
            }
        }
    </style>
</head>

<body>


    <header>
        Student Registration Form
    </header>

    <div class="main-content">
        <div class="form-container">
            <div class="form-header">
                <h2>Register Your Account</h2>
                <p>Fill in the details to create a new student account.</p>
            </div>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="fullName">Full Name</label>
                <input type="text" name="fullName" placeholder="Enter your full name" required>

                <label for="regNo">Registration Number</label>
                <input type="text" name="regNo" placeholder="Ex:2021CSC001/2021SP001" pattern="2021(CSC|SP)\d{3}" required>

                <label for="currentLevel">Current Level</label>
                <select name="currentLevel" required>
                    <option value="">Select Level</option>
                    <option value="1S">1S</option>
                    <option value="2S">2S</option>
                    <option value="3S">3S</option>
                    <option value="4S">4S</option>
                    <option value="1G">1G</option>
                    <option value="2G">2G</option>
                    <option value="3G">3G</option>
                    <option value="4G">4G</option>
                </select>

                <label for="indexNo">Index Number</label>
                <input type="text" name="indexNo" placeholder="Ex: S12345" required>

                <label for="nic">NIC</label>
                <input type="text" name="nic" placeholder="Enter your NIC" required>

                <label for="email">Email</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label for="contactNo">Contact Number</label>
                <input type="text" name="contactNo" placeholder="Enter your contact number" required>

                <label for="address">Address</label>
                <input type="text" name="address" placeholder="Enter your address" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <label for="rePassword">Re-enter Password</label>
                <input type="password" name="rePassword" placeholder="Re-enter your password" required>

                <label for="studyProgram">Study Program</label>
                <select name="studyProgram" required>
                    <option value="">Select Program</option>
                    <option value="directIntake">Direct Intake</option>
                    <option value="indirectIntake">Indirect Intake</option>
                </select>

                <label for="admissionDate">Admission Date</label>
                <input type="date" name="admissionDate" required>

                <label for="gender">Gender</label>
                <select name="gender" required>
                    <option value="">Select Gender</option>
                    <option value="MALE">Male</option>
                    <option value="FEMALE">Female</option>
                </select>

                <label for="profile_picture">Profile Picture</label>
                <input type="file" name="profile_picture" accept="image/*">

                <button type="submit" class="submit-button">Register</button>
            </form>
        </div>
    </div>

    <footer>
        &copy; 2024 University of Jaffna. All rights reserved.
    </footer>

</body>

</html>
