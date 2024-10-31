<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>UCIS | Login</title>
  <link rel="stylesheet" href="form.css">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer">
  <style>
    /* Reset margins and padding */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: Arial, sans-serif;
    }

    /* Background styling */
    body {
      background: url('BackgroundPic.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      flex-direction: column;
    }

    /* Navigation Bar Styling */
    .navbar {
      width: 100%;
      height: 17%;
      background-color: #233c98;
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 0px;
      position: fixed;
      top: 0;
      z-index: 10;
    }

    .navbar img {
      height: 120px;
      margin-left: 3px;
    }

    .navbar .admin-btn {
      color: #233c98;
      background-color: #f3f8ff;
      border: none;
      font-size: 22px;
      padding: 30px 20px;
      border-radius: 5px;
      text-decoration: none;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
    }

    .navbar .admin-btn:hover {
      background-color: #f3f8ff;
    }

    /* Centered Login Card Styling */
    .login-card {
      background-color: #f3f8ff;
      padding: 15px;
      width: 700px;
      border-radius: 10px;
      box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.4);
      text-align: center;
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 80px; /* Pushes the card below the navbar */
      margin-bottom: 30px;
      backdrop-filter: blur(5px);
    }

    .login-card h2 {
      font-size: 40px;
      color: #333;
      margin-bottom: 20px;
      font-weight: bold;
      /* font-weight: bold; */
    }
    .login-card h5{
      font-size: 20px;
      margin-bottom: 20px;
      font-weight: bold;
    }
    .icon-bg {
      font-size: 60px;
      color: #4CAF50;
      margin-bottom: 5px;
    }

    .form .text-input {
      position: relative;
      margin-bottom: 20px;
      width: 100%;
    }

    .form .text-input i {
      position: absolute;
      top: 50%;
      left: 10px;
      transform: translateY(-50%);
      color: #888;
    }

    .form input[type="text"],
    .form input[type="password"] {
      width: 100%;
      padding: 15px 15px 15px 40px;
      border: 1px solid #ddd;
      border-radius: 5px;
      font-size: 16px;
      color: #333;
      transition: border-color 0.3s;
    }

    .form input[type="text"]:focus,
    .form input[type="password"]:focus {
      border-color: #4CAF50;
      outline: none;
    }

    .form input[type="submit"],
    .form .btn {
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 5px;
      padding: 15px;
      font-size: 15px;
      cursor: pointer;
      width: 100%;
      transition: background-color 0.3s;
      margin-bottom: 15px;
    }

    .form input[type="submit"]:hover,
    .form .btn:hover {
      background-color: #45a049;
    }

    .forgot-pw-link,
    .form a {
      color: #888;
      font-size: 17px;
      text-decoration: none;
      display: inline-block;
      margin-top: 10px;
    }
    .btn{
      font-size: 17px;
    }
    .forgot-pw-link:hover,
    .form a:hover {
      color: #4CAF50;
    }
  </style>
</head>
<body>
  <div class="navbar">
    <img src="uni2.png" alt="University Logo">
    <a href="Adminlogin.php" class="admin-btn">Admin Login</a>
  </div>
  
  <div class="login-card">
    <h2>University Certification System</h2>
    <div class="icon-bg">
      <i class="fa-solid fa-user"></i>
    </div>
    <h5>Sign-in to your Account</h5>
    <form class="form" action="login.php" method="POST">
      <div class="text-input">
        <i class="fa-solid fa-user"></i>
        <input type="text" name="username" id="username" placeholder="Reg No (Ex: 2021CSC000)" required>
      </div>
      <div class="text-input">
        <i class="fa-solid fa-key"></i>
        <input type="password" name="password" id="password" placeholder="Password" required>
      </div>
      <input type="submit" name="login" value="Sign-In">
    </form>
    <a href="registrationForm.php" class="btn">Register Now</a>
    <a class="forgot-pw-link" href="#">Forgot Password?</a>
  </div>
</body>
</html>
