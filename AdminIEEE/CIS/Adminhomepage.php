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

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            background-color: #04AA6D;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        
        .footer {
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
            border-top: 2px solid black;
            background-color: #0f0377;
        }
        .head{
            width: 100%;
            height: 75px;
   
            background-color: #0f0377;
            display: grid;
            margin: auto;
            text-align: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;

        }
        .head h1{
            color: #ffffff;
        }
        .footer p{
            color: #ffffff;
        }
    </style>
</head>

<body>
    <header class="head">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM</h1>
    </header>

    <section class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li class="active"><a href="Adminhomepage.php">Home</a></li>
                <li><a href="verify.php">Verify</a></li>
                <li><a href="problems.php">View Problems</a></li>
                <li><a href="viewcomplains.php">View Complains</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!-- verticalnavi -->

        <h2>WELCOME TO UNIVERSITY CERTIFICATE ISSUING SYSTEM - UNIVERSITY OF JAFFNA</h2>

        <div class="mainbox">
            <div class="aboutsection">
                <section id="about">
                    <?php
                    ob_start();
                    include "../connect.php";
                    session_start();

                    // Check if the user is not logged in
                    if (!isset($_SESSION["username"])) {
                        header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in
                        exit();
                    }

                    $logged_in_username = $_SESSION["username"];

                    // SQL query to retrieve user details based on the username
                    $sql = "SELECT * FROM adminlogin WHERE username = '$logged_in_username'";
                    $result = mysqli_query($con, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        // Display user details
                        echo "Name: " . $row["username"] . "<br>";
                        echo "Type: " . $row["type"] . "<br>";
                        echo "Employee ID: " . $row["employeeID"] . "<br>";
                    } else {
                        echo "User not found.";
                    }

                    // Close the database connection
                    $con->close();
                    ?>
                </section>
            </div><!-- aboutsection -->

            <div class="flip-card">
                <div class="flip-card-inner">
                    <div class="flip-card-front">
                        <img src="https://www.w3schools.com/howto/img_avatar.png" alt="Avatar"
                            style="width:300px;height:300px;">
                    </div>
                </div>
            </div><!-- flip-card -->
        </div><!-- mainbox -->
    </section>

    <footer class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
    </footer>
</body>

</html>
