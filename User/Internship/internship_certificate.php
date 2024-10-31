<?php

include "../connect.php";
ob_start();
session_start();
$regNo=$_SESSION["username"];

if (isset($_POST['request'])) {
    
    $fullName = $_POST['fullName'];
    $company = $_POST['companyName'];
    $duration = $_POST['duration'];
    $appnumber = mt_rand(100000000, 999999999);

    $query = "UPDATE student SET fullName='$fullName', companyName='$company', internshipDuration='$duration', certificateID='$appnumber' WHERE regNo='$regNo'";
    mysqli_query($con, $query);
    echo "<script> alert('Request submitted successfully!')</script>";
    header("Location: UserDashboard.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UCIS | Internship Certificate Request</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body id="Dashboard">

    <div class="container">
        <div class="card complaint-card">
            <h3 class="topic">Request Internship Certificate</h3>
            <form class="form" method="post" action="">
                <div>
                    <div class="form-row">
                        <label for="fullName">Full Name: </label>
                        <input type="text" class="input" id="fullName" name="fullName" required />
                    </div>

                    <div class="form-row">
                        <label for="reg-no">Registration Number: </label>
                        <input type="text" class="input" id="reg-no" name="reg-no" value="<?php echo $regNo; ?>" readonly />
                    </div>

                    <div class="form-row">
                        <label for="companyName">Company Name: </label>
                        <input type="text" class="input" id="companyName" name="companyName" required />
                    </div>

                    <div class="form-row">
                        <label for="duration">Internship Duration: </label>
                        <input type="text" class="input" id="duration" name="duration" required />
                    </div>

                    <div class="btn-row">
                        <a href="UserDashboard.php" class="btn outline-btn">Back</a>
                        <input class="btn fill-btn" type="submit" name='request' value="Request Certificate" />
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p class="copyright">
            COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.
        </p>
    </div>

</body>
</html>
