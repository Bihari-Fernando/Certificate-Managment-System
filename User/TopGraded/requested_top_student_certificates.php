<?php
session_start();
include "../connect.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $regNo = $_POST['regNo'];
    $indexNo = $_POST['indexNo'];
    $fullName = $_POST['fullName'];
    $gpa = $_POST['gpa'];
    $academicYear = $_POST['academicYear'];
    $effectiveDate = date('Y-m-d');
    
    $insertQuery = "INSERT INTO topstudents (regNo,indexNo, fullName, gpa, academicYear,effectiveDate) 
                    VALUES ('$regNo','$indexNo', '$fullName', '$gpa', '$academicYear','$effectiveDate')";

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
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UCIS | Certificate Request</title>
    <link rel="stylesheet" href="" />
  </head>
  <style>
    /* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

/* Body Styling */
body#Dashboard {
    background-color: #f1f5f9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
}

/* Container Styling */
.container {
    max-width: 600px;
    width: 90%;
    margin: auto;
    padding: 20px;
}

/* Card Styling */
.card {
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    padding: 30px;
}

/* Form Styling */
.topic {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
    color: #1a237e;
}

.form {
    display: flex;
    flex-direction: column;
}

.form-row {
    margin-bottom: 15px;
}

.form-row label {
    display: block;
    font-weight: bold;
    color: #333;
    margin-bottom: 5px;
}

.form-row input[type="text"],
.form-row input[type="number"] {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
}

.form-row input[type="text"]:focus,
.form-row input[type="number"]:focus {
    border-color: #1a237e;
}

/* Button Styling */
.btn-row {
    display: flex;
    justify-content: space-between;
    margin-top: 20px;
}

.btn {
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 4px;
    cursor: pointer;
    text-align: center;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

.outline-btn {
    background-color: #fff;
    border: 2px solid #1a237e;
    color: #1a237e;
}

.outline-btn:hover {
    background-color: #1a237e;
    color: #fff;
}

.fill-btn {
    background-color: #1a237e;
    border: none;
    color: #fff;
}

.fill-btn:hover {
    background-color: #0d1b6b;
}

/* Footer Styling */
.footer {
    text-align: center;
    padding: 15px;
    margin-top: 30px;
}

.copyright {
    color: #666;
    font-size: 0.875rem;
}
.btn-row-inquiry{
  margin-top: 30px;
}

  </style>
  <body id="Dashboard">

  
    <div class="container">
      <div class="card complaint-card">
        <h3 class="topic">Fill the Form</h3>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          <div>
            <div class="form-row">
              <!-- <label for="reg-no">Registration No: </label> -->
              <label for="regNo">Registration Number:</label><br>
            <input type="text" id="regNo" name="regNo" required><br><br>
            </div>
            
            <div class="form-row">
            <label for="indexNo">Examination Index Number:</label><br>
            <input type="text" id="indexNo" name="indexNo" required><br><br>
            </div>
            
            
            <div class="form-row">
            <label for="fullName">Full Name:</label><br>
            <input type="text" id="fullName" name="fullName" required><br><br>
            </div>
            <div class="form-row">
            <label for="gpa">GPA:</label><br>
            <input type="number" step="0.01" id="gpa" name="gpa" required><br><br>
            </div>
            <div class="form-row">
            <label for="academicYear">Academic Year:</label><br>
            <input type="text" id="academicYear" name="academicYear" required><br><br>
            </div>
           
            
          <div class="btn-row">
            <a href="../UserDashboard.php" class="btn outline-btn">Back</a>
            <input
              class="btn fill-btn"
              type="submit"
              name='request'
              value="Request Certificate"/>
          </div>

          
        </form>
      </div>
    </div>
    <div class="btn-row-inquiry">
            <a class="btn outline-btn" href="Complaints.php">File any inquiries</a>
    <div class="footer">
      <p class="copyright">
        COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL
        RIGHTS RESERVED.
      </p>
    </div>
  </body>
</html>
