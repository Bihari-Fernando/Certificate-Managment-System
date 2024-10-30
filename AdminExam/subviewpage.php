<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>



    <link rel="stylesheet" href="style/subviewpage.css?=<?php echo time(); ?> ">

    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - EXAM ADMIN</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="homepage.php">Home</a></li>
                <li><a href="addDetails.php">Add Details</a></li>
                <li><a href="mainupdate.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Request</a></li>
                <li class="active"><a href="viewsearch.php">View and Search</a></li>
                <li><a href="logout.php">Log OUt</a></li>
            </ul>
        </div><!--verticalnavi-->


        <?php
            ob_start();
            include "connect.php";
            session_start();

            // Check if the user is not logged in
            if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Admin") {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
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
            $updateRegRow = getStdData($_GET['regNo']);

            ?>

        <div class="mainbox">
            
            <h1>Details of <?php echo $updateRegRow['regNo']; ?></h1>
            <table>
                <tr>
                    <td>Registration Number</td>
                    <td>:<?php echo $updateRegRow['regNo']; ?></td>
                </tr>

                <tr>
                    <td>Full Name</td>
                    <td>:<?php echo $updateRegRow['fullName']; ?></td>
                </tr>

                <tr>
                    <td>Faculty </td>
                    <td>:<?php echo $updateRegRow['faculty']; ?></td>
                </tr>

                <tr>
                    <td>Study Program </td>
                    <td>:<?php echo $updateRegRow['studyProgram']; ?></td>
                </tr>

                <tr>
                    <td>Index No</td>
                    <td>:<?php echo $updateRegRow['indexNo']; ?></td>
                </tr>

                <tr>
                    <td>NIC Number</td>
                    <td>:<?php echo $updateRegRow['nic']; ?></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>:<?php echo $updateRegRow['address']; ?></td>
                </tr>

                <tr>
                    <td>Contact No</td>
                    <td>:<?php echo $updateRegRow['contactNo']; ?></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>:<?php echo $updateRegRow['email']; ?></td>
                </tr>

                <tr>
                    <td>Academic Year</td>
                    <td>:<?php echo $updateRegRow['academicYear']; ?></td>
                </tr>

                <tr>
                    <td>OGPA</td>
                    <td>:<?php echo $updateRegRow['ogpa']; ?></td>
                </tr>

                <tr>
                    <td>Degree Class </td>
                    <td>:<?php echo $updateRegRow['degreeClass']; ?></td>
                </tr>

                <tr>
                    <td>Effective Date</td>
                    <td>:<?php echo $updateRegRow['effectiveDate']; ?></td>
                </tr>

                <tr>
                    <td>Study Type</td>
                    <td>:<?php echo $updateRegRow['studyType']; ?></td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td><img style= "width:50rem; height:30rem; margin-top:5rem; " src="../User/assets/<?php echo $updateRegRow['fileName']; ?>" ></td>
                </tr>
            </table>

            <a href="viewsearch.php"><button>Back</button></a>

            

            </div><!--mainbox-->
            


    </div><!--maincontent-->

</body>

</html>