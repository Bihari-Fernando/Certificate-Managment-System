<?php 
session_start(); 
include "connect.php";
$user = $_POST['username'];
$password = $_POST['password'];



if (isset($_POST['username']) && isset($_POST['password'])) 
{ 
    function validate($data)
    { 
        $data = trim($data); 
        $data = stripslashes($data); 
        $data = htmlspecialchars($data); 
        return $data; 
    }   
$uname = validate($_POST['username']);
$pass = validate($_POST['password']);
$_SESSION["username"] = $_POST['username'];



if (empty($uname))
{ 
    header("Location: index.php?error=User Name is required"); 
    exit();  
}
else if(empty($pass))
{  
    header("Location: index.php?error=Password is required");
    exit();  
}
else
    {  
        $sql = "SELECT * FROM students WHERE regNo='$uname' AND password='$pass'";
        $result = mysqli_query($conn, $sql); 
        if (mysqli_num_rows($result) === 1) 
        {  
            $row = mysqli_fetch_assoc($result);
            if ($row['regNo'] === $uname && $row['password'] === $pass)
            {    
                echo "Logged in!"; 
                $_SESSION['username'] = $row['regNo'];  
                header("Location:User/UserDashboard.php"); 
                exit();  
            }else
            {    
                header("Location:index.php?error=Incorrect User name or password"); 
                exit();     
            }     
        }
        else{ 
                header("Location:index.php?error=Incorrect User name or password");
                exit(); 
            } 
    }
}
else
{   
    header("Location:index.php");
    exit();
}
?>

