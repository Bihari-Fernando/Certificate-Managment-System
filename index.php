<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>UCIS | Login</title>
    <link rel="stylesheet" href="form.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer" />
  </head>
  <body>
    <div class="bg-img"></div>
    <div class="login-card grid-col" id="card">
      <div class="col certificate-col">
        <h2 class="col-title">Certificate Verification System</h2>
        <div class="icon-bg">
          <i class="fa-solid fa-certificate"></i>
        </div>
        <h5>Verify the certificate here</h5>
       
         <a href="verifiedCertificate.php"><button class="btn fill-btn submit-btn" type="submit" value="Verify" >Verify</button></a> 

      </div>
      <div class="line"></div>
      <div class="col login-col">
        <h2 class="col-title">University Certification System</h2>
        <div class="icon-bg">
          <i class="fa-solid fa-user"></i>
        </div>
        <h5>Sign-in to your Account</h5>
        <form class="form" action="login.php" method="POST">
          <div class="text-input">
            <i class="fa-solid fa-user"></i>
            <div class="line"></div>
            <input
              type="text"
              name="username"
              id="username"
              placeholder="Reg No(Ex:2021CSC000)" />
          </div>
          <div class="text-input">
            <i class="fa-solid fa-key"></i>
            <div class="line"></div>
            <input
              type="password"
              name="password"
              id="password"
              placeholder="Password" />
          </div>
          <input
            class="btn fill-btn submit-btn"
            type="submit"
            name ="login"
            value="Sign-In" />
            
        </form>
        <a href="registrationForm.php"><button class="btn fill-btn submit-btn" type="submit" value="Register Now" >Register Now</button></a> 
        <a class="forgot-pw-link" href="">Forgot Password?</a>

      </div>
    </div>
    <a href="Adminlogin.php" class="btn fill-btn admin-btn">Admin-Login</a>
  </body>
</html>
