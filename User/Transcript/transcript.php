<?php

include "../connect.php";
ob_start();
    session_start();
    $regNo=$_SESSION["username"];


if (isset($_POST['request'])) {
    
    $fullName = $_POST['fullName'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];
    $email = $_POST['mail'];
    $imageFile = $_FILES['payment'];
    $requestedDate = date('Y-m-d');

    if ($imageFile['error'] === 0) {
       
        $uploadDir = "assets/";
        $fileName = time() . '_' . basename($imageFile['name']);
        $filePath = $uploadDir . $fileName;

        if (move_uploaded_file($imageFile['tmp_name'], $filePath)) {
          $query = "INSERT INTO transcript (regNo, fullName, address, contactNo, status, email, fileName, requestedDate) 
          VALUES ('$regNo', '$fullName', '$address', '$contact', 'R', '$email', '$fileName', '$requestedDate')";

			
      mysqli_query($con, $query);
            echo "<script> alert('Image uploaded successfully!')</script>";
            header("Location: transcript.php");
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "Image upload failed with error code: " . $imageFile['error'];
    }
}

  ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UCIS | Certificate Request</title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body id="Dashboard">

  
    <div class="container">
      <div class="card complaint-card">
        <h3 class="topic">Fill the Form</h3>
        <form class="form" method="post" action="" enctype="multipart/form-data">
          <div>
            <div class="form-row">
              <!-- <label for="reg-no">Registration No: </label> -->
              <input type="text" class="input" id="reg-no" name="reg-no" value="<?php echo $regNo; ?>" hidden/>
            </div>
            
            <div class="form-row">
              <label for="fullName">Full Name: </label>
              <input type="text" class="input" id="fullName" name="fullName" />
            </div>
            
            
            <div class="form-row">
              <label for="address">Address: </label>
              <input type="tel" class="input" id="address" name="address" />
            </div>
            <div class="form-row">
              <label for="contact">Contact No: </label>
              <input type="tel" class="input" id="contact" name="contact" />
            </div>
            <div class="form-row">
              <label for="mail">Email: </label>
              <input type="email" class="input" id="mail" name="mail" />
            </div>
            <div class="form-row">
              <label for="payment_slip">Payment Slip: </label>
              <input
                type="file"
                class="input file-input"
                id="payment_slip"
                name="payment" >
            </div>
            
          <div class="btn-row">
            <a href="../UserDashboard.php" class="btn outline-btn">Back</a>
            <input
              class="btn fill-btn"
              type="submit"
              name='request'
              value="Request"/>
          </div>

          
        </form>
      </div>
    </div><br>
    
    <div class="btn-row-inquiry">
            <a class="btn outline-btn" href="Complaints.php">File any inquiries</a>
</div><br><br>
    
  </body>
</html>
