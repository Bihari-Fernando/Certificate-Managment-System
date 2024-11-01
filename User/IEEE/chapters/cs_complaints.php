<?php
ob_start();
session_start();
include "../../connect.php";

// Check if regNo is properly set in the session
if (!isset($_SESSION["username"])) {
    die("User is not logged in. Please log in to submit a complaint.");
}

$regNo = $_SESSION["username"];

// Check if the form was submitted and the description is set
if (isset($_POST["complaints"]) && isset($_POST["description"])) {
    $Description = $_POST["description"]; // Get the complaint description from the form

    // Prepare the INSERT query
    $query = "INSERT INTO cs (regNo, problems) VALUES ('$regNo', '$Description')";

    // Execute the query and check for success
    if (mysqli_query($con, $query)) {
      echo "<script>alert('Your complaint has been submitted successfully.');</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Close the database connection
mysqli_close($con);
?>



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Complaint Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, sans-serif;
      }

      .nav-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 20px;
        background-color: #004d99;
        color: #fff;
      }

      .logo {
        font-size: 24px;
        font-weight: bold;
      }

      .nav-links a {
        color: #fff;
        text-decoration: none;
        font-size: 18px;
        padding: 8px 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease;
      }

      .nav-links a.fill-btn {
        background-color: #007acc;
      }

      .nav-links a.fill-btn:hover {
        background-color: #005b99;
      }

      .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 80px);
        background-color: #f0f0f0;
        padding: 20px;
      }

      .card {
        background-color: #fff;
        width: 100%;
        max-width: 500px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 30px;
      }

      .topic {
        text-align: center;
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        font-weight: bold;
      }

      .form-row {
        margin-bottom: 15px;
        display: flex;
        flex-direction: column;
      }

      label {
        font-weight: bold;
        color: #555;
        margin-bottom: 5px;
      }

      .input,
      textarea {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 5px;
        resize: vertical;
      }

      .btn-row {
        display: flex;
        justify-content: space-between;
      }

      .btn {
        font-size: 16px;
        padding: 10px 20px;
        border-radius: 5px;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
      }

      .fill-btn {
        background-color: #007acc;
        color: #fff;
        border: none;
        transition: background-color 0.3s ease;
      }

      .fill-btn:hover {
        background-color: #005b99;
      }

      .outline-btn {
        background-color: transparent;
        color: #007acc;
        border: 2px solid #007acc;
        transition: background-color 0.3s ease, color 0.3s ease;
      }

      .outline-btn:hover {
        background-color: #007acc;
        color: #fff;
      }

      .footer {
        text-align: center;
        padding: 15px;
        background-color: #004d99;
        color: #fff;
        position: absolute;
        bottom: 0;
        width: 100%;
      }
    </style>
  </head>
  <body id="Dashboard">
    <nav class="nav-bar">
      <div class="nav-links">
        <h1 class="logo">UCIS</h1>
        
      </div>
    </nav>
    <div class="container">
      <div class="card complaint-card">
        <h3 class="topic">Fill the Form</h3>
        <form class="form" action="" method="post">
          <div class="form-row">
            <label for="description">Your complaint:</label>
            <textarea id="complaint" class="input" name="description" rows="4" cols="50"></textarea>
          </div>
          <div class="btn-row">
            <a href="UserDashboard.php" class="btn outline-btn">Back</a>
            <input class="btn fill-btn" name="complaints" type="submit" value="Submit" />
          </div>
        </form>
      </div>
    </div>
    <div class="footer">
      <p class="copyright">
        COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.
      </p>
    </div>
  </body>
</html>
