<?php
session_start();
include "../../connect.php"; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fullName = $_POST['fullName'];
    $regNo = $_POST['regNo'];
    $membership = $_POST['membership'];
    $membershipNo = $_POST['membershipNo'];
    $sessionName =  $_POST['sessionName'];
    $sessionDate =  $_POST['sessionDate'];
    $requestedDate = date('Y-m-d');
  
    $query = "INSERT INTO cis 
              (fullName, regNo, membership, membershipNo, sessionName, sessionDate,requestedDate) 
              VALUES ('$fullName', '$regNo', '$membership', '$membershipNo', '$sessionName', '$sessionDate','$requestedDate')";
    
    if (mysqli_query($con, $query)) {
        echo "<script>alert('Your request sent successfully!');</script>";
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
/* Styling for IEEE Membership Dropdown */
.form-row select {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
    appearance: none; /* For custom styling on some browsers */
}

.form-row select:focus {
    border-color: #1a237e;
}

/* Styling for Date Input */
.form-row input[type="date"] {
    width: 100%;
    padding: 10px;
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
}

.form-row input[type="date"]:focus {
    border-color: #1a237e;
}
/* Container styling to position the dropdown arrow */
.form-row {
    position: relative; /* Needed for absolute positioning of the icon */
}

.form-row select {
    width: 100%;
    padding: 10px;
    padding-right: 40px; /* Adds space for the dropdown icon */
    border-radius: 4px;
    border: 1px solid #ccc;
    font-size: 1rem;
    outline: none;
    appearance: none; /* Removes the default arrow */
    background-color: #fff;
}

/* Custom dropdown arrow styling */
.form-row select::after {
    content: '';
    position: absolute;
    top: 50%;
    right: 15px;
    width: 0;
    height: 0;
    border-left: 5px solid transparent;
    border-right: 5px solid transparent;
    border-top: 7px solid #1a237e;
    transform: translateY(-50%);
    pointer-events: none; /* Prevents the arrow from interfering with clicking */
}


  </style>
  <body id="Dashboard">

  
    <div class="container">
      <div class="card complaint-card">
        <h3 class="topic">Fill the Form</h3>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          <div>
            <div class="form-row">
            <label for="fullName">Full Name:</label>
            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
            </div>
            


            <div class="form-row">
            <label for="regNo">Registration Number:</label>
            <input type="text" id="regNo" name="regNo" placeholder="Enter your registration number" required>
            </div>
            
            
            <div class="form-row">
            <label for="membership">IEEE Membership:</label>
            <select id="membership" name="membership" required>
                <option value="Yes">Yes</option>
                <option value="No">No</option>
            </select>
            </div>
            <div class="form-row">
            <label for="membershipNo">IEEE Membership No:</label>
            <input type="text" id="membershipNo" name="membershipNo" 
                   placeholder="Enter membership number (if applicable)">

            </div>
            <div class="form-row">
            <label for="sessionName">Session Name:</label>
            <input type="text" id="sessionName" name="sessionName" 
                   placeholder="Enter format: Session-name(First letter capital)" required pattern="IEEE-[A-Za-z0-9-]+" 
                   title="Format: IEEE-Session-2024">

            </div>
            <div class="form-row">
            <label for="sessionDate">Session Date:</label>
            <input type="date" id="sessionDate" name="sessionDate" required>

            </div>
            
            
           
            
          <div class="btn-row">
            <a href="../../UserDashboard.php" class="btn outline-btn">Back</a>
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
            <a class="btn outline-btn" href="cis_complaints.php">File any inquiries</a>
    <div class="footer">
      <p class="copyright">
        COPYRIGHT &copy; 2024 DEPARTMENT OF COMPUTER SCIENCE UNIVERSITY OF JAFFNA. ALL
        RIGHTS RESERVED.
      </p>
    </div>
  </body>
</html>
