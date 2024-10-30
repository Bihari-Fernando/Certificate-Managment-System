<?php
// Start a session (if not already started)
ob_start();
include "connect.php";
session_start();


if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: ../login.php");
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
            background-color: rgb(88, 172, 172);
            background-image: linear-gradient(to bottom, #dacff1, #f3f3f3, #c0c5d8);
        }
        .logout-box {
            width: 45%;
            height: 600px;
            margin: auto;
            display: flex;
            background-color: rgb(200, 173, 220);
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
				<img src="th.jpg" class="image">
				<p>Confirm logout?</p>
                <form action="">
                <button class="btn"><a class="link" href="?logout=true"></a>Logout</button><br><br>
                </form>

            </div>
        </div>
    </div>
</body>

</html>
