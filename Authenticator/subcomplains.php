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
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - AUTHENTICATOR</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
        <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li ><a href="newdetails.php">New Details</a></li>
                <li><a href="updatedetails.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Request</a></li>
                <li ><a href="viewsearch.php">View and Search</a></li>
                <li ><a href="viewproblems.php">View problemss</a></li>
                <li class="active"><a href="viewcomplains.php">View Complains</a></li>

                <li ><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->


        <?php
            ob_start();
            include "connect.php";
            session_start();

            // Check if the user is not logged in
            if (!isset($_SESSION["username"]) ) {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
            }

            

            function getStdData($regNo)
            {
                global $conn;
                $query = " SELECT * from complaintss where regNo='$regNo' ";

                $result = mysqli_query($conn, $query);
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
                    <td><?php echo $updateRegRow['regNo']; ?></td>
                </tr>

                <tr>
                    <td>Full Name</td>
                    <td><?php echo $updateRegRow['name']; ?></td>
                </tr>

               

                <tr>
                    <td>Description</td>
                    <td><?php echo $updateRegRow['description']; ?></td>
                </tr>

            </table>

            <a href="viewcomplains.php"><button>Back</button></a>

            

            </div><!--mainbox-->
            


    </div><!--maincontent-->

</body>

</html>