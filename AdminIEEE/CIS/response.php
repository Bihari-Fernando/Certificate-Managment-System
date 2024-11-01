<?php
session_start();
include "../connect.php";

// Fetch the problem information based on the id parameter
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM cis WHERE id = ?";
    $stmt = mysqli_prepare($con, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $obj = mysqli_fetch_assoc($result);
}

// Handle form submission for the response
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['response']) && isset($_GET['id'])) {
    $response = $_POST['response'];
    $id = $_GET['id'];

    // Update the response in the database for the given id
    $updateQuery = "UPDATE cis SET responses = ?, problem_status = 'V' WHERE id = ?";
    $stmt = mysqli_prepare($con, $updateQuery);
    mysqli_stmt_bind_param($stmt, "si", $response, $id);
    mysqli_stmt_execute($stmt);

    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "<script>alert('Your response was sent successfully and the problem status was updated!');</script>";
    } else {
        echo "<script>alert('Error: No record was updated.');</script>";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Response page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f9;
            color: #333;
        }
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
        <form action="response.php?id=<?php echo $id; ?>" method="POST">
            <label><h2>Response</h2></label><br>
            <textarea name="response" class="large-textarea"></textarea><br>
            <button type="submit">Send Response</button>
        </form>
    </div>
</body>
</html>
