<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hmoe page-welcome</title>


    <link rel="stylesheet" href="style/home.css?=<?php echo time(); ?> ">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>

</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - AUTHENTICATOR</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
        <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="Adminhomepage.php">Home</a></li>
                <li ><a href="newdetails.php">New Details</a></li>
                <li><a href="updatedetails.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Request</a></li>
                <li ><a href="viewsearch.php">View and Search</a></li>
                <li ><a href="viewproblems.php">View Problems</a></li>
                <li ><a href="viewcomplains.php">View Complains</a></li>
                <li ><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->
        <h2>
                WELCOME TO UNIVERSITY CERTIFICATE ISSUING SYSTEM UNIVERSITY OF JAFFNA
            </h2>
        <div class="mainbox">
            

            <div class="aboutsection">
                <section id="about">
                <?php
                ob_start();
                include "connect.php";
                    session_start();

                    // Check if the user is not logged in
                    if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Authenticator") {
                        header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                        exit();
                    }

                    $logged_in_username = $_SESSION["username"];

                    // SQL query to retrieve user details based on the username
                    $sql = "SELECT * FROM adminlogin WHERE username = '$logged_in_username'";
                    $result=mysqli_query($con,$sql);

                    if (mysqli_num_rows($result)>0) {
                        $row = $result->fetch_assoc();
                        // Display user details
                        
                        echo "Name: " . $row["username"] . "<br>";
                        echo "Type: " . $row["type"] . "<br>";
                        echo "Department: " . $row["department"] . "<br>";
                        echo "Employee ID: " . $row["employeeID"] . "<br>";
                        
                        // You can add more user details as needed
                    } else {
                        echo "User not found.";
                    }

                    // Close the database connection
                    $con->close();

                  ?>

                    
                </section>
            </div><!--aboutsection-->
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar"
                            style="width:300px;height:300px;">
                    </div>
                    <div class="flip-card-back">
                        <h1>John Doe</h1>
                        <p>Architect & Engineer</p>
                        <p>Computer Science</p>
                    </div>
                </div>
            </div><!--flip-card-->
         </div><!--mainbox-->





    </div><!--maincontent-->

</body>

</html>