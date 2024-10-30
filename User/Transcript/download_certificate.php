<?php

ob_start();
session_start();
include "connect.php";
$regNo = $_SESSION['username'];
$query = "SELECT * from student WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);

$obj = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>OCDS | Download Certificate</title>
  <link rel="stylesheet" href="style.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
    integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body id="certificate-details">
  <nav class="nav-bar">
    <div class="nav-links">
      <h1 class="logo">OCDS</h1>
      <a class="btn fill-btn" href="logout.php">Logout</a>
    </div>
  </nav>
  <div class="container">
    <div class="card complaint-card"   id='in'>
        <div class="certificate-code">
          <p style="font-size:12px"><span style="color:red;">*</span> Computer generated copy</p>
          <p class="code"><?php echo $obj['certificateID'] ?></p>
        </div>
        <div class="certificate-title">
          <h3 class="title">University of Jaffna, Sri Lanka</h3>
          <h4 class="sub-title">Academic Transcript</h4>
        </div>
      <!--
    <div class="certificateNo: ">
      <form action="" method="post">
        <span>Certificate No: </span><input type="text" name="certifcate">
        <input type="submit" name="certify" value="certify">
      </form>
    </div>
-->
     


       <!-- <script>
  // Function to generate PDF
  function generatePDF() {
    // Create a new jsPDF instance
    const doc = new jsPDF();

    // Get the content of your web page
    const content = document.getElementById('content-to-pdf');

    // Add the content to the PDF
    doc.addHTML(content, function () {
      // Save the PDF as "output.pdf"
      doc.save('output.pdf');
    });
  } -->

   <!-- Attach a click event listener to the button
  document.getElementById('download-pdf').addEventListener('click', generatePDF);
</script>  -->
       
          <div class="certificate-details">

            <div class="detail-row-grid2">
              <h5>Full Name of the student: </h5>
              <p>
                <?php echo $obj['fullName'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Registration Number of the student: </h5>
              <p>
                <?php echo $obj['regNo'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Contact Phone number: </h5>
              <p>
                <?php echo $obj['contactNo'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Postal Address: </h5>
              <p>
                <?php echo $obj['address'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Followed the programme: </h5>
              <p>
                <?php echo $obj['studyProgram'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Field of Specialization(if any): </h5>
              <p>
                <?php echo $obj['studyType'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Overall Result: </h5>
              <p>
                <?php echo $obj['degreeClass'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Course Duration: </h5>
              <p>
                <?php echo $obj['courseDuration'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Effective Date of the Degree: </h5>
              <p>
                <?php echo $obj['effectiveDate'] ?>
              </p>
            </div>
            <div class="detail-row-grid2">
              <h5>Overall G.P.A: </h5>
              <p>
                <?php echo $obj['ogpa'] ?>
              </p>
            </div>
            
            <div class="detail-row-grid2">
              <h5>Status: </h5>
              <p style="color: green !important">
                <?php echo $obj['status'] ?>
              </p>
            </div>
            <p>Visit ucis.infinityfreeapp.com to verify</p>
          </div>
      <center><button id="download-button" class="btn fill-btn">Download as PDF</button></center>
    </div>
  </div>
  <?php ?>
  <div class="footer">
    <p class="copyright">
      COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL
      RIGHTS RESERVED.
    </p>
  </div>
  
</body>

</html>

<script>
  // const button = document.getElementById('download-button');

  // function generatePDF() {
  // 	// Choose the element that your content will be rendered to.
  // 	const element = document.getElementById('in');
  // 	// Choose the element and save the PDF for your user.
  // 	html2pdf().from(element).save();
  // }

  // button.addEventListener('click', generatePDF);

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