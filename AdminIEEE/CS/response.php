<?php
ob_start();
session_start();
include "../connect.php";

// Fetching the student's information from the database
$query = "SELECT * FROM cs";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $response = $_POST['response'];
   
    // Assuming regNo is present in the $obj fetched above
    $regNo = $obj['regNo'];

    // Using UPDATE instead of INSERT with WHERE clause
    $updateQuery = "UPDATE cs SET responses = ? WHERE regNo = ?";
    $stmt = mysqli_prepare($con, $updateQuery);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ss', $response, $regNo);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_affected_rows($stmt) > 0) {
            // Update the problem_status column to "V"
            $statusUpdateQuery = "UPDATE cs SET problem_status = 'V' WHERE regNo = ?";
            $statusStmt = mysqli_prepare($con, $statusUpdateQuery);
            
            if ($statusStmt) {
                mysqli_stmt_bind_param($statusStmt, 's', $regNo);
                mysqli_stmt_execute($statusStmt);
                
                if (mysqli_stmt_affected_rows($statusStmt) > 0) {
                    echo "<script>alert('Your response was sent successfully and the problem status was updated!');</script>";
                } else {
                    echo "<script>alert('Your response was sent, but there was an error updating the problem status.');</script>";
                }
                mysqli_stmt_close($statusStmt);
            } else {
                echo "Error updating problem status: " . mysqli_error($conn);
            }
        } else {
            echo "Error: No record was updated.";
        }
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response page</title>
    <style>
        /* Body styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
            color: #333;
        }

        /* Description styling */
        .description {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        
        .description h1 {
            font-size: 1.5em;
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .description p {
            font-size: 1.1em;
            color: #555;
            line-height: 1.5;
        }

        /* Form styling */
        form {
            padding: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label h2 {
            font-size: 1.3em;
            color: #34495e;
            margin: 0 0 10px;
        }

        /* Textarea styling */
        .large-textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            font-size: 1em;
            border: 1px solid #ccc;
            border-radius: 4px;
            resize: vertical;
            box-sizing: border-box;
        }

        /* Button styling */
        button[type="submit"] {
            margin-top: 10px;
            padding: 10px 20px;
            background-color: rgb(0, 47, 175);
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1em;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #3498db;
        }
    </style>
</head>
<body>
    <div class="description">
    <h2>Problem Description</h2>
    
    <p><?php echo isset($obj['problems']) ? htmlspecialchars($obj['problems']) : "No description available"; ?></p>
    </div>
    <div>
        <form action="" method="POST">
            <label><h2>Response</h2></label><br>
            <textarea name="response" class="large-textarea"></textarea><br>
            <button type="submit">Send Response</button>
        </form>
    </div>
</body>
</html>
