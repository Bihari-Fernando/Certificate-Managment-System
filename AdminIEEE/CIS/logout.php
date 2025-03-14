<?php
// Start a session (if not already started)
ob_start();
include "../connect.php";
session_start();

// Check if the user is already logged in
if (!isset($_SESSION["username"]) ) {
    header("Location: ../../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
    exit();
}

// If logout is requested, destroy the session and redirect to the login page
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../../Adminlogin.php");

    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: 0;
        }
        .main {
            display: flex;
            width: 100%;
            height: 100vh;
            margin: 0;
            align-items: center;
            background-color: #dbe6f3;
        }
        .logout-box {
            width: 45%;
            height: 600px;
            margin: auto;
            display: flex;
            background-color: rgb(200, 173, 220);
            background-color: rgba(35, 60, 152, 0.9);
            font-family: 'Poppins', sans-serif;
            box-shadow: 4px 4px 10px rgba(114, 114, 114, 0.9);
            border-radius: 10px;
        }
        .input-box {
            width: 60%;
            height: 350px;
            margin: auto;
            align-items: center;
            background-color: #fff;
            background-color: #f3f8ff;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }
        .input-box h1 {
            margin-top: 10px;
            margin-left: 20px;
        }
        .input-box form input {
            width: 70%;
            height: 30px;
            margin-left: 20px;
            border-radius: 5px;
        }
		.image {
			width:100px;
            height: 100px;
		}
		p{
			margin-top:40px;
			margin-bottom:10px;
		}

        button{
            height: 40px;
            font-size: 17px;
            width: 100px;
            border: none;
            border-radius: 20px;
            background-color: rgb(64, 8, 123);
            background-color: #233c98;
            color: white;
            cursor: pointer;
        }

        .link{
            position: absolute;
            z-index: 1;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
        }
        .btn{
            position: relative;
        }
    </style>
</head>

<body>
    <div class="main">
        <div class="logout-box">

            <div class="input-box">
                <h1>User Logout</h1><br><br>
				
				<img src="logout.jpeg" class="image">
				<p>Confirm logout?</p>
                <form action="">
                <button class="btn"><a class="link" href="?logout=true"></a>Logout</button><br><br>
                </form>

            </div>
        </div>
    </div>
</body>

</html>