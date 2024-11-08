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

<section>
<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM</h1>
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

            if (!isset($_SESSION["username"]) ) {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
            }


            if(isset($_POST['add'])){

                $regNo=$_POST['regNo'];
                $fullName=$_POST['fullName'];
                
                $studyProgram=$_POST['studyProgram'];
                $indexNo=$_POST['indexNo'];
                $nic=$_POST['nic'];
                $address=$_POST['address'];
                $contactNo=$_POST['contactNo'];
                $email=$_POST['email'];
                $academicYear=$_POST['academicYear'];
                $studyType=$_POST['studyType']; 
                $ogpa=$_POST['ogpa'];
                $degreeClass=$_POST['degreeClass'];
                $effectiveDate=$_POST['effectiveDate'];
               // $status=$_POST['status'];

                $query=" SELECT * from transcript where regNo='$regNo' ";
                
                $result=mysqli_query($con,$query);
                
                if(mysqli_num_rows($result)==1){
                    echo "<script>alert('Reg No or NIC or Index No taken by someone.')</script>";
                }
                else{
                    $query="INSERT INTO student(regNo,fullName,studyProgram,indexNo,nic,address,contactNo,email,academicYear,studyType,ogpa,degreeClass,effectiveDate,status) VALUES('$regNo','$fullName','$studyProgram','$indexNo','$nic','$address','$contactNo','$email','$academicYear','$studyType','$ogpa','$degreeClass','$effectiveDate','N')";
                    mysqli_query($con,$query);
                    //echo $query;
                    //exit;
                    header("location:addDetails.php");
                }
                

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
                            <p>Study Program</p>
                            <input type="text" name="studyProgram">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Index No</p>
                            <input type="text" name="indexNo">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>NIC Number</p>
                            <input type="text" name="nic">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Address</p>
                            <input type="text" name="address">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Contact No</p>
                            <input type="text" name="contactNo">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Email</p>
                            <input type="text" name="email">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Academic Year</p>
                            <input type="text" name="academicYear">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>OGPA</p>
                            <input type="text" name="ogpa">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Degree Class</p>
                            <select name="degreeClass" id="">
                                <option value="first">First Class</option>
                                <option value="second upper">Second Class Upper</option>
                                <option value="second lower">Second Class Lower</option>
                                <option value="No Class">No Class</option>
                            </select>
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Effective Date</p>
                            <input type="date" name="effectiveDate">
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Medium</p>
                            <select name="st-inputdata-medium" id="">
                                <option value="English">English</option>
                                <option value="sinhala">Sinhala</option>
                                <option value="tamil">Tamil</option>
                            </select>
                        </div><!--studentinput-->
                        <div class="studentinput">
                            <p>Study Type</p>
                            <select name="studyType" id="">
                                <option value="3 Years">General</option>
                                <option value="4 Years">Honors</option>

                            </select>
                        </div><!--studentinput-->
                        
                        <input type="submit" name="add" value="ADD">


                    </form>
                    
                </div><!--studentform-->
                <div class="studentxlfile">
                <h2>Choose afile to upload:</h2>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
                        <label for="file"></label>
                        <input type="file" name="file" id="file"><br><br>
                        <input type="submit" value="Upload CSV" name="submit">
                    </form>
                </div><!--studentxlfile-->
            </div><!--studentformmain-->

        </div><!--mainbox-->
        
        <!-- <form class="" action="" method="post" enctype="multipart/form-data">
                        <input type="file" name="excel" required value="">
                        <button type="submit" name="import">Import</button>
                    </form> -->


                <?php
                include "connect.php";

                if (isset($_POST["submit"])) {
                    if (empty($file)) {
                        // die("File path is empty!");
                    }
                    else{
                        $file = $_FILES["file"]["name"];
                    $handle = fopen($file, "r");
                
                    // (C) IMPORT ROW BY ROW
                    while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                        $stmt = $mysqli->prepare("INSERT INTO student (regNo,fullName,faculty,studyProgram,indexNo,nic,address,contactNo,email,academicYear,studyType,ogpa,degreeClass,effectiveDate,status,filename) VALUES('$regNo','$fullName','$faculty','$studyProgram','$indexNo','$nic','$address','$contactNo','$email','$academicYear','$studyType','$ogpa','$degreeClass','$effectiveDate','N','')");
                        $stmt->bind_param("sss", $data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7], $data[8], $data[9], $data[10], $data[11], $data[12], $data[13], $data[14], $data[15]);
                        $stmt->execute();
                    }
                
                    fclose($handle);
                    echo "CSV file imported successfully!";
                }
                }


           
		?>

               





    </div><!--maincontent-->

</body>
</section>
<footer class="footer">
        <p class="text-footer">COPYRIGHT &copy; 2024 DEPARTMENT OF COMPUTER SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
</footer>


</html>
