<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ob_start();
include("connect.php");
session_start();

$error_message = "";  // Initialize error message variable

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_SESSION["username"])) {
    if ($_SERVER['PHP_SELF'] == '/Adminlogin.php') {
        if ($_SESSION["type"] == "Exam Admin") {
            header("Location: AdminExam/Adminhomepage.php");
        } elseif ($_SESSION["type"] == "Admin") {
            header("Location: Admin/Adminhomepage.php");
        } elseif ($_SESSION["type"] == "Authenticator") {
            header("Location: Authenticator/Adminhomepage.php");
        } elseif ($_SESSION["type"] == "Top Graded") {
            header("Location:AdminTopGraded/Adminhomepage.php");
        }elseif ($_SESSION["type"] == "Internship Admin") {
            header("Location:AdminInternship/Adminhomepage.php");
        }elseif ($_SESSION["type"] == "CIS chapter Admin") {
            header("Location:AdminIEEE/CIS/Adminhomepage.php");
        }
        elseif ($_SESSION["type"] == "CS Chapter Admin") {
            header("Location:AdminIEEE/CS/Adminhomepage.php");
        }
        elseif ($_SESSION["type"] == "WIE Chapter Admin") {
            header("Location:AdminIEEE/WIE/Adminhomepage.php");
        }

        exit();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $user_type = $_POST["type"];
    $password = $_POST['password'];

    

    // Use a prepared statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM adminlogin WHERE username = ? AND type = ?");
    $stmt->bind_param("ss", $username, $user_type);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    echo "Number of rows found: " . mysqli_num_rows($result) . "<br>";

    $row = mysqli_fetch_assoc($result);

    // Debugging: Print the fetched row data
    if ($row) {
        
        
        $_SESSION["username"] = $username;
        $_SESSION["type"] = $user_type;
        $hashpassword = $row["password"];

        // Check if the entered password matches the hashed password in the database
        if ($password == $hashpassword) {
            echo "Password verified successfully! Redirecting...<br>";

            // Redirect based on user type
            switch ($user_type) {
                case "Exam Admin":
                    header("Location: AdminExam/Adminhomepage.php");
                    exit();
                case "Admin":
                    header("Location: Admin/Adminhomepage.php");
                    exit();
                case "Top Graded":
                    header("Location: AdminTopGraded/Adminhomepage.php");
                    exit();
                case "Authenticator":
                    header("Location: Authenticator/Adminhomepage.php");
                    exit();
                
                case "Internship Admin":
                    header("Location: AdminInternship/Adminhomepage.php");
                    exit(); 
                case "CIS chapter Admin":
                    header("Location: AdminIEEE/CIS/Adminhomepage.php");
                    exit(); 
                case "CS Chapter Admin":
                    header("Location: AdminIEEE/CS/Adminhomepage.php");
                    exit(); 
                case "WIE Chapter Admin":
                    header("Location: AdminIEEE/WIE/Adminhomepage.php");
                    exit();             
                default:
                    $error_message = "Unknown user type!";
                    break;
            }
        } else {
            // If the password is incorrect, set an error message
            $error_message = "Incorrect password!";
        }
    } else {
        // If no user found with the given username and type, set an error message
        $error_message = "Invalid username, password, or user type. Please try again.";
    }
}

$conn->close();
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
            margin: auto;
            align-items: center;
            background-color: rgb(88, 172, 172);
            background-image: linear-gradient(to bottom, #dacff1, #f3f3f3, #c0c5d8);
        }
        .login-box {
            width: 65%;
            height: 500px;
            margin: auto;
            display: flex;
            background-color: rgb(200, 173, 220);
            font-family: 'Poppins', sans-serif;
            box-shadow: 4px 4px 10px rgba(114, 114, 114, 0.9);
            border-radius: 10px;
        }
        .input-box {
            width: 60%;
            height: 250px;
            margin: auto;
            align-items: center;
            background-color: #fff;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }
        .input-box h1 {
            margin-top: 10px;
            margin-left: 20px;
        }
        .input-box form input, a {
            width: 70%;
            height: 30px;
            margin-left: 20px;
            border-radius: 5px;
        }
        .input-box a {
            text-decoration: none;
            color: black;
            font-weight: 700;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="login-box">
            <div class="input-box box1">
                <h2>Admin Login</h2>
                <?php
                if (isset($error_message) && $error_message != "") {
                    echo "<p style='color: red;'>$error_message</p>";
                }
                ?>
                <form method="post">
                    <label for="username">User Name:</label>
                    <input type="text" id="username" name="username" required><br><br>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br><br>
                    <label for="type">User Type:</label>
                    <select id="type" name="type" required>
                        <option value="Admin">Admin</option>
                        <option value="Top Graded">Top Graded</option>
                        <option value="Exam Admin">Exam Admin</option>
                        <option value="Authenticator">Authenticator</option>
                        <option value="Internship Admin">Internship Admin</option>
                        <option value="CIS chapter Admin">CIS chapter Admin</option>
                        <option value="CS Chapter Admin">CS Chapter Admin</option>
                        <option value="WIE Chapter Admin">WIE Chapter Admin</option>

                    </select><br><br>
                    <input style="height: 30px; background-color: rgb(64, 8, 123); color: white;" type="submit" name="admin-login" value="Login"><br><br>
                </form>
                <a href="login.php">Back To Login</a>
            </div>
        </div>
    </div>
</body>
</html>
