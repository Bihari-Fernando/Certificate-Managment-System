<?php
session_start();
include "../connect.php";

// Handle the form submission to insert a new student record
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $regNo = $_POST['regNo'];
    $indexNo = $_POST['indexNo'];
    $fullName = $_POST['fullName'];
    $gpa = $_POST['gpa'];
    $academicYear = $_POST['academicYear'];

    
    $insertQuery = "INSERT INTO topstudents (regNo,indexNo, fullName, gpa, academicYear) 
                    VALUES ('$regNo','$indexNo', '$fullName', '$gpa', '$academicYear')";

    if (mysqli_query($con, $insertQuery)) {
        echo "<script>alert('Your sent successfully!');</script>";
        
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Graded Student Certificates</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

.nav-bar {
    background-color: #333;
    overflow: hidden;
    
}

.nav-links a {
    float: left;
    color: #fff;
    padding: 14px 20px;
    text-decoration: none;
}

.nav-links a:hover {
    background-color: #ddd;
    color: black;
}

.container {
    margin: 10px;
    margin-top: 150px;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

input {
    width: 100%;
    padding: 8px;
    margin: 8px 0;
    box-sizing: border-box;
}

.btn {
    background-color: #04AA6D;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
}

.btn:hover {
    background-color: #45a049;
}

table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

.footer {
    text-align: center;
    margin-top: 30px;
}

    </style>
</head>
<body>
    <nav class="nav-bar">
        <div class="nav-links">
            <a href="User/UserDashboard.php">Dashboard</a>
            <a href="requested_top_student_certificates.php" class="active">Top Graded Certificates</a>
            <a href="logout.php">Logout</a>
        </div>
    </nav>

    <div class="container">
      
        <form method="POST" action="">
            <label for="regNo">Registration Number:</label><br>
            <input type="text" id="regNo" name="regNo" required><br><br>

            <label for="indexNo">Examination Index Number:</label><br>
            <input type="text" id="indexNo" name="indexNo" required><br><br>

            <label for="fullName">Full Name:</label><br>
            <input type="text" id="fullName" name="fullName" required><br><br>

            <label for="gpa">GPA:</label><br>
            <input type="number" step="0.01" id="gpa" name="gpa" required><br><br>

            <label for="academicYear">Academic Year:</label><br>
            <input type="text" id="academicYear" name="academicYear" required><br><br>

            <button type="submit" class="btn fill-btn">Request Certificate</button>
        </form>

        
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
    </div>
</body>
</html>
