<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Details</title>


    <link rel="stylesheet" href="style/adddetails.css?=<?php echo time(); ?> ">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>




</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - ADMIN</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
        <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li class="active"><a href="addDetails.php">Add Details</a></li>
                <li><a href="mainupdate.php">Update Details</a></li>
                <li><a href="managerequest.php">Manage Request</a></li>
                <li><a href="viewsearch.php">View and Search</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->

        <?php 
            ob_start();
            include "connect.php";
            session_start();

            if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Exam Admin") {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
            }


            if(isset($_POST['add'])){

                $regNo=$_POST['regNo'];
                $fullName=$_POST['fullName'];
                $faculty=$_POST['faculty'];
                $nic=$_POST['nic'];
                $date=$_POST['date'];
                $type=$_POST['type'];
                $description=$_POST['description'];
                
                $query="INSERT INTO problems(regNo,name,faculty,nic,date,type,description) VALUES('$regNo','$fullName','$faculty','$nic','$date','$type','$description')";
                mysqli_query($con,$query);
                header("location:addDetails.php");
                }

            ?>
        
        <div class="mainbox">
        <h2>Add Student Details</h2>
            
            <div class="studentformmain">
                <div class="studentform">
                    <form action="" method="post">
                        <div class="studentinput">
                            <p>Registration Number</p>
                            <input type="" name="regNo" placeholder="2020/XXX/000">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Full Name</p>
                            <input type="text" name="fullName">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Faculty</p>
                            <input type="text" name="faculty">
                        </div><!--studentinput-->
                        
                        <div class="studentinput">
                            <p>NIC Number</p>
                            <input type="text" name="nic">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Date</p>
                            <input type="date" name="date">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Type</p>
                            <select name="type" id="">
                                <option value="financial">Financial</option>
                                <option value="diciplinery">Diciplinery</option>
                                <option value="other">Other</option>
                            </select>
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Description</p>
                            <input type="text" name="description">
                        </div><!--studentinput-->
                        <input type="submit" name="add" value="ADD">


                    </form>
                    
                </div><!--studentform-->
                <div class="studentxlfile">
                    <h3>You can upoload your XL files here!</h3>
                    <div class="mb">

                        <input class="form-control" type="file" id="formFileMultiple" multiple>
                        <input type="submit" name="upload" value="Upload">
                    </div>
                </div><!--studentxlfile-->
            </div><!--studentformmain-->

        </div><!--mainbox-->





    </div><!--maincontent-->

</body>

</html>