<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OCDS | Download Certificate</title>
    <link rel="stylesheet" href="form.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
  </head>
  <body id="certificate-details">
    <nav class="nav-bar">
      <div class="nav-links">
        <h1 class="logo">OCDS</h1>
        <a class="btn fill-btn" href="login.php">Logout</a>
      </div>
    </nav>
    <div class="container">
      <div class="card complaint-card">
		<div class="certificate-code">
			<p style="font-size:12px"><span style="color:red;">*</span> Computer generated copy</p>
			<p class="code">129432</p>
		</div>
		<div class="certificate-title">
				<h3 class="title">University of Jaffna, Sri Lanka</h3>
				<h4 class="sub-title">Academic Transcript</h4>
		</div>

    <div class="certificateNo: ">
      <form action="" method="post">
        <span>Certificate No: </span><input type="text" name="certifcate">
        <input type="submit" name="certify" value="certify">
      </form>
    </div>

    <?php 
    
    ob_start();
    session_start();
    include "connect.php";
    
    if(isset($_POST['certify']))
{

  $CertificateNo = $_POST['certifcate'];
  $query = "SELECT * from student WHERE certificateID='$CertificateNo'";
  $res= mysqli_query($con,$query);
  $obj =mysqli_fetch_assoc($res);
  

 ?>
        <div class="certificate-details">
            <div class="detail-row-grid2">
              <h5>Full Name of the student: </h5>
              <p><?php echo $obj['fullName'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Registration Number of the student: </h5>
              <p><?php echo $obj['regNo']?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Contact Phone number: </h5>
              <p><?php echo $obj['contactNo'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Postal Address: </h5>
              <p><?php echo $obj['address'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Followed the programme: </h5>
              <p><?php echo $obj['studyProgram'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Field of Specialization(if any): </h5>
              <p><?php echo $obj['studyType'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Overall Result: </h5>
              <p><?php echo $obj['degreeClass'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Course Duration: </h5>
              <p><?php echo $obj['courseDuration'] ?></p>
            </div>
            <div class="detail-row-grid2">
              <h5>Effective Date of the Degree: </h5>
              <p><?php echo $obj['effectiveDate']?></p>
            </div>
			<div class="detail-row-grid2">
              <h5>Overall G.P.A: </h5>
              <p><?php echo $obj['ogpa']?></p>
</div>
			<div class="detail-row-grid2">
              <h5>Status: </h5>
              <p style="color: green !important"><?php echo $obj['status']?></p>
            </div>
          </div>
          <!--<center><a href="#" class="btn fill-btn">Download</a></center>-->
      </div>
    </div>
    <?php } ?>
    <div class="footer">
      <p class="copyright">
        COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL
        RIGHTS RESERVED.
      </p>
    </div>
  </body>
</html>
