<?php
session_start();
include "../connect.php";

// Handle the verification request
if (isset($_POST['verify'])) {
    $regNo = $_POST['regNo'];

    // Update query to set status to 'V' (Verified)
    $updateQuery = "UPDATE cis SET status = 'V' WHERE regNo = '$regNo'";
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Student verified successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch all student data from the internship table
$query = "SELECT * FROM cis";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Verify Department Approved Internship Certificate</title>

    <link rel="stylesheet" href="style/mainupdate.css?=<?php echo time(); ?> ">
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="style.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .btn {
            background-color: #0f0377;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
        
        .footer {
            text-align: center;
            padding: 15px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.2);
            border-top: 2px solid black;
            background-color: #0f0377;
        }
        .head{
            width: 100%;
            height: 75px;
   
            background-color: #0f0377;
            display: grid;
            margin: auto;
            text-align: center;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;

        }
        .head h1{
            color: #ffffff;
        }
        .footer p{
            color: #ffffff;
        }
    </style>
</head>
<body>
    <header class="head">
        <h1>UNIVERSITY CERTIFICATE ISSUING SYSTEM</h1>
    </header>
    
    <section>
    <div class="maincontent">
        <div class="verticalnavi">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="Adminhomepage.php">Home</a></li>
                <li class="active"><a href="verify.php">Verify</a></li>
                <li><a href="problems.php">View Problems</a></li>
                <li><a href="logout.php">Log Out</a></li>
            </ul>
        </div>
    
        <div class="mainbox">
            <div class="updatebox">
            <table>
            <thead>
                <tr>
                    <th>Registration Number</th>
                    <th>Full Name</th>
                    <th>Membership</th>
                    <th>Membership No</th>
                    <th>Session Name</th>
                    <th>Session Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo $row['regNo']; ?></td>
                        <td><?php echo $row['fullName']; ?></td>
                        <td><?php echo $row['membership']; ?></td>
                        <td><?php echo $row['membershipNo']; ?></td>
                        <td><?php echo $row['sessionName']; ?></td>
                        <td><?php echo $row['sessionDate']; ?></td>
                        <td>
                            <?php
                            if ($row['status'] == 'V') {
                                echo "Verified";
                            } else {
                                echo "Not Verified";
                            }
                            ?>
                        </td>
                        <td>
                            <form method="POST" action="">
                                <input type="hidden" name="regNo" value="<?php echo $row['regNo']; ?>">
                                <button type="submit" name="verify" class="btn" 
                                    <?php echo ($row['status'] == 'V') ? 'disabled' : ''; ?>>
                                    Verify
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
                
            </div>
        </div>
    </section>                        
    
    <footer class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>                   
    </footer>
</body>
</html>
