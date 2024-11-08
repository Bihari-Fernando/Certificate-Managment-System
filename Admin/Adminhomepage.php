<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page - Welcome</title>

    <link rel="stylesheet" href="style/home.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM</h1>
    </header>
    <section>
    <div class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="Adminhomepage.php">Home</a></li>
                <li><a href="addDetails.php">Add Details</a></li>
                <li><a href="mainupdate.php">Update Details</a></li>
                <li><a href="viewsearch.php">View and Search</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->
        <h2>WELCOME TO UNIVERSITY CERTIFICATE ISSUING SYSTEM - UNIVERSITY OF JAFFNA</h2>
        <div class="mainbox">
            <div class="aboutsection">
                <section id="about">
                    <?php
                    ob_start();
                    include "connect.php";
                    session_start();

                    


                    // Check if the user is not logged in
                    if (!isset($_SESSION["username"])) {
                        header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in
                        exit();
                    }

                    $logged_in_username = $_SESSION["username"];

                    // SQL query to retrieve user details based on the username
                    $sql = "SELECT * FROM adminlogin WHERE username = '$logged_in_username'";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        // Display user details
                        echo "Name: " . $row["username"] . "<br>";
                        echo "Type: " . $row["type"] . "<br>";
                        echo "Department: " . $row["department"] . "<br>";
                        echo "Employee ID: " . $row["employeeID"] . "<br>";
                    } else {
                        echo "User not found.";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </section>
            </div><!--aboutsection-->
            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar"
                            style="width:300px;height:300px;">
                    </div>
                </div>
            </div><!--flip-card-->
        </div><!--mainbox-->
    </div><!--maincontent-->
    </section>
    <footer class="footer">
        <p class="text-footer">COPYRIGHT &copy; 2024 DEPARTMENT OF COMPUTER SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
    </footer>
</body>

</html>
