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
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - ADMIN</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li><a href="addDetails.php">Add Details</a></li>
                <li class="active"><a href="mainupdate.php">Update Details</a></li>
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
                            if (!isset($_SESSION["username"]) ) {
                                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                                exit();
                            }

                            if (isset($_POST['update'])) {
                                $regNo = (isset($_POST['regNo']) ? $_POST['regNo'] : null);
                                $fullName = (isset($_POST['name']) ? $_POST['name'] : null);
                                $faculty = (isset($_POST['faculty']) ? $_POST['faculty'] : null);
                                $nic = (isset($_POST['nic']) ? $_POST['nic'] : null);
                                $date = (isset($_POST['date']) ? $_POST['date'] : null);
                                $type = (isset($_POST['type']) ? $_POST['type'] : null);
                                $description = (isset($_POST['description']) ? $_POST['description'] : null);
                               
                                $query = "UPDATE problems SET name='$fullName', faculty='$faculty',nic='$nic', date='$date',type='$type',description='$description' WHERE regNo='$regNo' ";
                                $result = mysqli_query($con, $query);

                                header("location:mainupdate.php");
                            }

                            function getStdData($regNo)
                            {
                                global $conn;
                                $query = " SELECT * from problems where regNo='$regNo' ";

                                $result = mysqli_query($conn, $query);
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
                                <input type="text" name="name" value=<?php echo $updateRegRow['name']; ?>>
                            </div><!--studentinput-->
                            
                            <div class="studentinput">
                                <p>NIC Number</p>
                                <input type="text" name="nic" value=<?php echo $updateRegRow['nic']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Date</p>
                                <input type="text" name="date" value=<?php echo $updateRegRow['date']; ?>>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Type</p>
                                <select name="type" id="">
                                    <option value="financial">Financial</option>
                                    <option value="diciplinery">Diciplinery</option>
                                    <option value="other">Other</option>
                                </select>
                            </div><!--studentinput-->
                            <div class="studentinput">
                                <p>Description</p>
                                <input type="text" name="description" value=<?php echo $updateRegRow['description']; ?>>
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