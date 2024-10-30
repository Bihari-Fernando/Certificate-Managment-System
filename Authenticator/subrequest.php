<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Details</title>



    <link rel="stylesheet" href="style/subviewpage.css?=<?php echo time(); ?> ">

    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>

<body>
    <header class="heading">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM - AUTHENTICATOR</h1>
    </header>
    <div class="maincontent">
        <div class="verticalnavi">
        <ul class="nav nav-pills nav-stacked">
                <li ><a href="Adminhomepage.php">Home</a></li>
                <li ><a href="newdetails.php">New Details</a></li>
                <li><a href="updatedetails.php">Update Details</a></li>
                <li class="active"><a href="managerequest.php">Manage Request</a></li>
                <li ><a href="viewsearch.php">View and Search</a></li>
                <li ><a href="viewproblems.php">View Problems</a></li>
                <li ><a href="viewcomplains.php">View Complains</a></li>
                <li ><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->


        <?php
            ob_start();
            include "connect.php";
            session_start();

            // Check if the user is not logged in
            if (!isset($_SESSION["username"]) || $_SESSION["type"] !== "Authenticator") {
                header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                exit();
            }
          
            if (isset($_POST['issue'])) {
                //echo $regNo;
                $regNo=$_POST['regNo'];

                $query = "UPDATE student SET  status='I' WHERE regNo='$regNo'";
                echo $query;
                mysqli_query($con, $query);
                header("location:managerequest.php");
            }

            if (isset($_POST['delete'])) {
                //echo $regNo;
                $regNo=$_POST['regNo'];

                $query = "UPDATE student SET  status='A' WHERE regNo='$regNo'";
                echo $query;
                mysqli_query($con, $query);
                header("location:managerequest.php");
            }


            function getStdData($regNo)
            {
                global $con;
                $query = " SELECT * from student where regNo='$regNo' ";

                $result = mysqli_query($con, $query);
                if (mysqli_num_rows($result) > 0) {
                    return mysqli_fetch_array($result);
                }
                return null;
            }
            $updateRegRow = getStdData($_GET['regNo'])
            ?>


        <div class="mainbox">
            
            <h1>Request details of <?php echo $updateRegRow['regNo']; ?></h1>
            <?php       print_r($_POST);?>
            <table>
                <tr>
                    <td>Registration Number</td>
                    <td>:<?php echo $updateRegRow['regNo']; ?></td>
                </tr>

                <tr>
                    <td>Full Name</td>
                    <td>:<?php echo $updateRegRow['fullName']; ?></td>
                </tr>

                <tr>
                    <td>Faculty </td>
                    <td>:<?php echo $updateRegRow['faculty']; ?></td>
                </tr>

                <tr>
                    <td>Study Program </td>
                    <td>:<?php echo $updateRegRow['studyProgram']; ?></td>
                </tr>

                <tr>
                    <td>Index No</td>
                    <td>:<?php echo $updateRegRow['indexNo']; ?></td>
                </tr>

                <tr>
                    <td>NIC Number</td>
                    <td>:<?php echo $updateRegRow['nic']; ?></td>
                </tr>

                <tr>
                    <td>Address</td>
                    <td>:<?php echo $updateRegRow['address']; ?></td>
                </tr>

                <tr>
                    <td>Contact No</td>
                    <td>:<?php echo $updateRegRow['contactNo']; ?></td>
                </tr>

                <tr>
                    <td>Email</td>
                    <td>:<?php echo $updateRegRow['email']; ?></td>
                </tr>

                <tr>
                    <td>Academic Year</td>
                    <td>:<?php echo $updateRegRow['academicYear']; ?></td>
                </tr>

                <tr>
                    <td>OGPA</td>
                    <td>:<?php echo $updateRegRow['ogpa']; ?></td>
                </tr>

                <tr>
                    <td>Degree Class </td>
                    <td>:<?php echo $updateRegRow['degreeClass']; ?></td>
                </tr>

                <tr>
                    <td>Effective Date</td>
                    <td>:<?php echo $updateRegRow['effectiveDate']; ?></td>
                </tr>

                <tr>
                    <td>Study Type</td>
                    <td>:<?php echo $updateRegRow['studyType']; ?></td>
                </tr>
                <tr>
                    <td>Payment</td>
                    <td><img style= "width:50rem; height:30rem; margin-top:5rem; " src="../User/assets/<?php echo $updateRegRow['fileName']; ?>" ></td>
                </tr>
            </table>

                <button  onclick="req('<?php echo $updateRegRow['regNo'];?>','issue')">issue</button>
                <button  onclick="req('<?php echo $updateRegRow['regNo'];?>','delete')">Delete</button>

            

            </div><!--mainbox-->
            


    </div><!--maincontent-->

</body>
<script>
  function req(reg,tag){
    var frm =document.createElement("form");
    frm.action= "";
    frm.method="post";
    var inp =document.createElement("input");
    inp.name = "regNo";
    inp.value =reg;
    frm.appendChild(inp);
    var inp2 =document.createElement("input");
    inp2.name = tag;
    frm.appendChild(inp2);
    document.body.appendChild(frm);
    frm.submit();
  }
</script>

</html>