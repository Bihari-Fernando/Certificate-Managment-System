<?php

ob_start();
session_start();
include "../../connect.php";

// Assuming the regNo is set for the logged-in user
$regNo = $_SESSION['username'];

// Fetching the student's information from the database
$query = "SELECT * FROM cis WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Certificate</title>
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
      background-color: #f4f4f4;
      color: #333;
    }

    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      flex-direction: column;
    }

    .card {
      background: #F4FEFE;
      border-radius: 15px;
      padding: 40px;
      width: 800px;
      height: 600px;
      max-width: 100%;
      border: 8px solid #433CF8; /* Border color */
      text-align: center;
      box-sizing: border-box;
    }

    .logo-section {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-bottom: 20px;
    }

    .logo-section img {
      height: 80px;
      margin-right: 10px;
    }

    .university-title {
      font-size: 18px;
      color: #333;
      font-weight: bold;
    }

    .certificate-title {
      font-size: 28px;
      font-weight: bold;
      margin: 15px 0;
    }

    .presented-to {
      font-size: 20px;
      margin: 10px 0;
    }

    .participant-name {
      font-size: 26px;
      font-weight: bold;
      color: #2721D0; /* Orange color for participant name */
      margin: 5px 0;
    }

    .event-details {
      font-size: 18px;
      margin: 15px 0;
    }

    .session-title {
      font-size: 24px;
      font-weight: bold;
    }

    .session-date {
      font-size: 16px;
      margin-top: 10px;
    }

    .signatures {
      display: flex;
      justify-content: space-between;
      margin-top: 30px;
    }

    .signature-block {
      text-align: center;
      font-size: 14px;
    }

    /* Button Styles */
    .btn.fill-btn {
      background-color: #4CAF50;
      color: white;
      border: none;
      padding: 10px 15px;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
      transition: background-color 0.3s ease;
      margin-top: 20px;
    }

    .btn.fill-btn:hover {
      background-color: #45a049;
    }

    /* Vertical bar styles */
    .vertical-bar {
      width: 2px;
      height: 50px; /* Adjust the height to match the content */
      background-color: black; /* Vertical bar color */
      margin: 0 15px; /* Space between the logo and text */
    }

    footer {
      text-align: center;
      padding: 5px 0;
      background:#2083FD ;
      color: white;
      width: 100%;
      position: relative;
      bottom: 0;
    }
  </style>
</head>

<body id="certificate-details">
  <div class="container">
    <div class="card complaint-card" id='in'>
      <div class="logo-section">
        <img src="IEEE_CIS.png">
        <div class="vertical-bar"></div>
        <div class="university-title">
          <p>University of Jaffna Student Branch Chapter</p>
        </div>
      </div>

      <div class="certificate-title">
        CERTIFICATE OF PARTICIPATION
      </div>

      <div class="presented-to">
        is presented to
      </div>

      <div class="participant-name">
        <?php echo $obj['fullName']; ?>
      </div>

      <div class="event-details">
        for attending
        <div class="session-title">
          <?php echo $obj['sessionName']; ?>
        </div>
        <div class="session-date">
          held on <?php echo $obj['sessionDate']; ?>, <br>
          at the Department of Computer Science, University of Jaffna.
        </div>
      </div>

      <div class="signatures">
        <div class="signature-block">
          <img src="a.png">
          <p>Dr. E.Y.A. Charles</p>
          <p>Counsellor</p>
          <p>IEEE Student Branch, University of Jaffna</p>
        </div>
        <div class="signature-block">
          <img src="b.png">
          <p>Prof. M. Siyamalan</p>
          <p>Advisor, IEEE Computer Society</p>
          <p>University of Jaffna</p>
        </div>
      </div>
    </div>

    <button class="btn fill-btn" id="download-button">Download as PDF</button>
  </div>

  <footer>
    <p class="copyright">
      COPYRIGHT &copy; 2024 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.
    </p>
  </footer>
  
</body>

</html>


<script>
    document.getElementById('download-button').addEventListener('click', () => {
      const element = document.getElementById('certificate-details');
      html2pdf(element, {
        margin: 0,
        filename: 'certificate.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: 'a4', orientation: 'portrait' }
      });
    });
  </script>