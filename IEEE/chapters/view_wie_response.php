<?php
ob_start();
session_start();
include "../../connect.php";

// Check database connection
if (!$con) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Validate that the user is logged in
if (!isset($_SESSION['username'])) {
    echo "You are not logged in.";
    exit;
}

$regNo = $_SESSION['username'];

// Get the 'id' from the query string
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Validate the 'id'
if (!$id) {
    echo "No problem ID specified.";
    exit;
}

// Fetch the specific problem and response for the current user
$query = "SELECT id, responses, problems FROM wie WHERE regNo = ? AND id = ?";
$stmt = mysqli_prepare($con, $query);

if ($stmt === false) {
    die("Error preparing statement: " . mysqli_error($con));
}

// Bind parameters and execute the statement
mysqli_stmt_bind_param($stmt, "si", $regNo, $id); // Assuming 'id' is an integer
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);

if ($result === false) {
    die("Error executing query: " . mysqli_error($con));
}

// Check if there are results
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $problem = htmlspecialchars($row['problems']);
    $response = htmlspecialchars($row['responses']);
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
        h1, h2 {
            color: #333;
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
    <div class="container">
        <h1>Problem and Response</h1>
        <div>
            <p><strong>Problem:</strong> <?php echo $problem ? $problem : "Problem not found."; ?></p>
            <p><strong>Response:</strong> <?php echo $response ? $response : "No response found for this problem."; ?></p>
        </div>
    </div>
    <div class="footer">
        &copy; <?php echo date("Y"); ?> Your Application Name
    </div>
</body>
</html>
<?php
} else {
    echo "No problem found with the specified ID.";
}
?>
