<?php
ob_start();
session_start();
include "../connect.php";

// Check database connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Validate that the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit;
}

$regNo = $_SESSION['username'];
$currentDate= date('Y-m-d');
// Get the 'id' from the query string
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Validate the 'id'
if (!$id) {
    echo "No problem ID specified.";
    exit;
}

// Fetch the specific problem and response for the current user
$query = "SELECT * FROM topstudents WHERE regNo = ? AND id = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($con));
}

// Bind parameters and execute the statement
mysqli_stmt_bind_param($stmt, "si", $regNo, $id); // Assuming 'id' is an integer
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result === false) {
    die("Error executing query: " . mysqli_error($con));
}

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $obj = mysqli_fetch_assoc($result);
    
?> 
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DCS | Download Internship Completion Certificate</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <style>
    body {
      font-family: 'Georgia', serif;
      background-color: #f7f5f0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }

    .certificate-container {
      width: 790px;
      padding: 40px;
      border: 15px solid #8a4b08;
      background-color: #fff;
      text-align: center;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    }

    .certificate-border {
      border: 3px solid #8a4b08;
      padding: 20px;
      position: relative;
    }

    .header {
      font-size: 36px;
      font-weight: bold;
      color: #4a2f00;
      margin-bottom: 10px;
    }

    .sub-header {
      font-size: 20px;
      color: #8a4b08;
      margin-bottom: 20px;
    }

    .certificate-title {
      font-size: 28px;
      color: #333;
      margin-top: 40px;
      margin-bottom: 20px;
      font-style: italic;
    }

    .content {
      font-size: 18px;
      line-height: 1.6;
      margin: 20px;
    }

    .highlight {
      font-weight: bold;
      color: #4a2f00;
    }

    /* University Logo */
    .logo-image {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 80px;
      height: auto;
    }

    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 40px;
    }

    .signature {
      text-align: center;
    }

    .signature-line {
      margin-top: 30px;
      border-top: 1px solid #8a4b08;
      width: 200px;
      margin: auto;
    }

    .date {
      text-align: right;
      margin-top: 10px;
      font-size: 16px;
      color: #4a2f00;
    }

    .btn-container {
      margin-top: 20px;
    }

    .btn {
      background-color: #8a4b08;
      color: white;
      padding: 10px 20px;
      border-radius: 5px;
      cursor: pointer;
      border: none;
      font-size: 16px;
    }

    .footer {
      text-align: center;
      font-size: 14px;
      color: #777;
      margin-top: 20px;
      padding: 10px;
    }
  </style>
</head>

<body>
  <div class="certificate-container" id="certificate-content">
    <div class="certificate-border">
      <!-- University Logo Inside Certificate Border -->
      <img src="uni2.png" alt="University of Jaffna Logo" class="logo-image">

      <div class="header">University of Jaffna</div>
      <div class="sub-header">Faculty of Science, Department of Computer Science</div>
      <div class="certificate-title">Top Graded Students Certificate</div>
      <div class="content">
    The Department of Computer Science at the University of Jaffna proudly recognizes the academic excellence demonstrated by our top-graded students each year. For this year, we are pleased to commend <span class="highlight"><?php echo $obj['fullName']; ?></span>, who achieved the highest grade point average (GPA) of <span class="highlight"><?php echo $obj['gpa']; ?></span> in their cohort. Their outstanding performance and dedication exemplify the values of academic rigor and commitment to excellence upheld by the department.
</div>


      <div class="signatures">
        <div class="signature">
          <div class="signature-line"></div>
          <p>Head of Department</p>
        </div>
        <div>
          <p>Date: <?php echo $currentDate; ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="btn-container">
    <button id="download-button" class="btn">Download as PDF</button>
  </div>
  
  

  <script>
    const button = document.getElementById('download-button');

    function generatePDFWithDelay() {
      button.disabled = true;
      setTimeout(function () {
        const element = document.getElementById('certificate-content');
        html2pdf().from(element).save();
        button.disabled = false;
      }, 5000);
    }

    button.addEventListener('click', generatePDFWithDelay);
  </script>
</body>
</html><?php
} else {
    echo "No problem found with the specified ID.";
}
?>
