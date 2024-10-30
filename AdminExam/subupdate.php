<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Details</title>



    <link rel="stylesheet" href="style/subupdate.css?=<?php echo time(); ?> ">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - EXAM ADMIN</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li><a href="addDetails.php">Add Details</a></li>
                <li class="active"><a href="mainupdate.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Reueset</a></li>
                <li><a href="viewsearch.php">View and Search</a></li>
                <li><a href="logout.php">Log OUt</a></li>
            </ul>
        </div><!--verticalnavi-->
        <div class="mainbox">
            <div class="subupdatebox">
                <div class="studentformmain">
                    <div class="studentform">
                        <form action="" method="post">

                            <?php
                            ob_start();
                            include "connect.php";
                            session_start();

                            // Check if the user is not logged in
                            if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Admin") {
                                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                                exit();
                            }

                            if (isset($_POST['update'])) {
                                $regNo = (isset($_POST['regNo']) ? $_POST['regNo'] : null);
                                $fullName = (isset($_POST['fullName']) ? $_POST['fullName'] : null);
                                $faculty = (isset($_POST['faculty']) ? $_POST['faculty'] : null);
                                $studyProgram = (isset($_POST['studyProgram']) ? $_POST['studyProgram'] : null);
                                $indexNo = (isset($_POST['indexNo']) ? $_POST['indexNo'] : null);
                                $nic = (isset($_POST['nic']) ? $_POST['nic'] : null);
                                $address = (isset($_POST['address']) ? $_POST['address'] : null);
                                $contactNo = (isset($_POST['contactNo']) ? $_POST['contactNo'] : null);
                                $email = (isset($_POST['email']) ? $_POST['email'] : null);
                                $academicYear = (isset($_POST['academicYear']) ? $_POST['academicYear'] : null);
                                $studyType = (isset($_POST['studyType']) ? $_POST['studyType'] : null);
                                $ogpa = (isset($_POST['ogpa']) ? $_POST['ogpa'] : null);
                                $degreeClass = (isset($_POST['degreeClass']) ? $_POST['degreeClass'] : null);
                                $effectiveDate = (isset($_POST['effectiveDate']) ? $_POST['effectiveDate'] : null);
                                // $payment=$_POST['payment'];
                                // $status=$_POST['status'];
                                //Debug


                                $query = "UPDATE student SET fullName='$fullName', faculty='$faculty', studyProgram='$studyProgram', indexNo='$indexNo', nic='$nic', address='$address', contactNo=$contactNo, email='$email', academicYear='$academicYear', studyType='$studyType', ogpa='$ogpa', degreeClass='$degreeClass', effectiveDate='$effectiveDate', status='U' WHERE regNo='$regNo' ";
                                // $query = " SELECT * from student where regNo='$regNo' ";
                               // echo $query;
                                $result = mysqli_query($con, $query);

                                // if (mysqli_num_rows($result) >  0) {
                                // mysqli_query($con, $query);
                                header("location:mainupdate.php");
                                // } else {
                                // echo "<script>alert('Reg No or NIC or Index No taken by someone.')</script>";
                                // }
                            }
                            function getStdData($regNo)
                            {
                                global $con;
                                $query = " SELECT * from student where regNo='$regNo' ";

                                $result = mysqli_query($con, $query);
                                if (mysqli_num_rows($result) > 0) {
                                    return mysqli_fetch_array($result);
                                }
                                return null;
                            }
                            $updateRegRow = getStdData($_GET['regNo'])
                            ?>

                            <div class="studentinput">
                                <p>Registration Number</p>
                                <label><?php echo $updateRegRow['regNo']; ?></label>
                                <input type="hidden" name="regNo" value="<?php echo $updateRegRow['regNo']; ?>">
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Full Name</p>
                                <input type="text" name="fullName" value=<?php echo $updateRegRow['fullName']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Faculty</p>
                                <input type="text" name="faculty" value=<?php echo $updateRegRow['faculty']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Study Program</p>
                                <input type="text" name="studyProgram" value=<?php echo $updateRegRow['studyProgram']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Index No</p>
                                <input type="text" name="indexNo" value=<?php echo $updateRegRow['indexNo']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>NIC Number</p>
                                <input type="text" name="nic" value=<?php echo $updateRegRow['nic']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Address</p>
                                <input type="text" name="address" value=<?php echo $updateRegRow['address']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Contact No</p>
                                <input type="text" name="contactNo" value=<?php echo $updateRegRow['contactNo']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Email</p>
                                <input type="text" name="email" value=<?php echo $updateRegRow['email']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Academic Year</p>
                                <input type="text" name="academicYear" value=<?php echo $updateRegRow['academicYear']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>OGPA</p>
                                <input type="text" name="ogpa" value=<?php echo $updateRegRow['ogpa']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Degree Class</p>
                                <input type="text" name="degreeClass" value=<?php echo $updateRegRow['degreeClass']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Effective Date</p>
                                <input type="text" name="effectiveDate" value=<?php echo $updateRegRow['effectiveDate']; ?> placeholder="DD/MM/YYYY">
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Study Type</p>
                                <select name="studyType" id="">
                                    <option value="3 Years">General</option>
                                    <option value="4 Years">Honors</option>

                                </select>
                            </div><!--studentinput-->
                            <input type="submit" name="update" value="Update">


                        </form>
                    </div><!--studentform-->

                </div><!--studentformmain-->
            </div><!--subupdatebox-->
        </div><!--mainbox-->


    </div><!--maincontent-->

</body>

</html>