<?php
ob_start();
session_start();
include "../connect.php";
 

$regNo = $_SESSION['username'];

// Fetching the student's information from the database
$query = "SELECT responses, problems FROM internship WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Responses</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #333;
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            margin: 10px 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            h1 {
                font-size: 20px;
            }

            p {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <h1>Problem</h1>
    <p><?php echo $obj['problems']?></p>
    <h1>Reponse</h1>
    <p><?php echo $obj['responses']?></p>
</body>
</html>