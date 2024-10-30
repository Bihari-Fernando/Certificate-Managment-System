<?php

ob_start();
session_start();
include "../../connect.php";

// Assuming the regNo is set for the logged-in user
$regNo = $_SESSION['username'];

// Fetching the student's information from the database
$query = "SELECT * FROM wie WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title></title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
       
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4; /* Light grey background for the whole page */
    color: #333; /* Dark text color for readability */
}

.nav-bar {
    background-color: #4CAF50; /* Green background for the navigation */
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.nav-links .logo {
    color: white;
    font-size: 24px;
    font-weight: bold;
}

.nav-links .btn {
    background-color: white; /* White button for logout */
    color: #4CAF50; /* Green text color for button */
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.nav-links .btn:hover {
    background-color: #ddd; /* Light grey on hover */
}

.container {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 40px;
}

.card {
    background: white;
    border-radius: 15px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    padding: 30px;
    width: 700px; /* Set a fixed width for the certificate card */
    text-align: left; /* Align text to the left for a formal look */
}

.certificate-code {
    text-align: center;
    margin-bottom: 20px;
}

.certificate-title {
    text-align: center;
    margin: 20px 0;
}

.certificate-title .title {
    font-size: 24px;
    color: #4CAF50; /* Green color for title */
}

.certificate-title .sub-title {
    font-size: 18px;
    color: #666; /* Darker grey for subtitle */
}

.certificate-details {
    margin: 20px 0;
}

.detail-row-grid2 {
    display: flex;
    justify-content: space-between;
    margin: 10px 0;
}

.detail-row-grid2 h5 {
    margin: 0; /* Remove default margin */
    font-weight: normal; /* Make headings normal weight */
}

.detail-row-grid2 p {
    margin: 0;
    color: #555; /* Slightly lighter grey for detail text */
}

footer {
    text-align: center;
    padding: 20px 0;
    background: #4CAF50; /* Same green background for footer */
    color: white;
    position: relative;
    bottom: 0;
    width: 100%;
}

.footer .copyright {
    margin: 0;
}

/* Button Styles */
.btn.fill-btn {
    background-color: #4CAF50; /* Green button */
    color: white;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.btn.fill-btn:hover {
    background-color: #45a049; /* Darker green on hover */
}

    </style>
</head>

<body id="certificate-details">
  <nav class="nav-bar">
    <div class="nav-links">
      <h1 class="logo">Logo of CIS</h1>
      <a class="btn fill-btn" href="logout.php">Logout</a>
    </div>
  </nav>
  <div class="container">
    <div class="card complaint-card" id='in'>
        <div class="certificate-code">
          <p style="font-size:12px"><span style="color:red;">*</span> Computer generated copy</p>
          <p class="code"><?php echo $obj['certificateID'] ?></p>
        </div>
        <div class="certificate-title">
          <h3 class="title">University of Jaffna, Sri Lanka</h3>
          <h4 class="sub-title">Certificate of WIE session participation </h4>
        </div>
        <div class="certificate-details">
          <div class="detail-row-grid2">
            <h5>Full Name of the Student: </h5>
            <p><?php echo $obj['fullName'] ?></p>
          </div>
          <div class="detail-row-grid2">
            <h5>Session Name: </h5>
            <p><?php echo $obj['sessionName'] ?></p>
          </div>
         
         
        </div>
        <center><button id="download-button" class="btn fill-btn">Download as PDF</button></center>
    </div>
  </div>
  <div class="footer">
    <p class="copyright">
      COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.
    </p>
  </div>
  
</body>

</html>

<script>
  const button = document.getElementById('download-button');

  function generatePDFWithDelay() {
    // Disable the button to prevent multiple clicks during the delay
    button.disabled = true;

    // Set a 5-second (5000 milliseconds) delay before generating the PDF
    setTimeout(function () {
      // Choose the element that your content will be rendered to.
      const element = document.getElementById('in');
      // Choose the element and save the PDF for your user.
      html2pdf().from(element).save();

      // Re-enable the button after the PDF is generated
      button.disabled = false;
    }, 5000); // 5000 milliseconds = 5 seconds
  }

  button.addEventListener('click', generatePDFWithDelay);
</script>