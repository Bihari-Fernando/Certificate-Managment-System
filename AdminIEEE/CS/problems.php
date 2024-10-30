<?php
session_start();
include "../connect.php";

// Fetch only unresolved problems from the problems table
$query = "SELECT * FROM cs WHERE responses IS NULL OR responses = ''";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Problems</title>

    <link rel="stylesheet" href="style/mainupdate.css?=<?php echo time(); ?> ">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css?=<?php echo time(); ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js?=<?php echo time(); ?>"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js?=<?php echo time(); ?>"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css=<?php echo time(); ?>">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        /* Internal styles */
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 10px; text-align: left; border-bottom: 1px solid #ddd; }
        .btn { background-color: rgb(0, 47, 175); color: white; border: none; padding: 10px 20px; cursor: pointer; }
        .btn:disabled { background-color: #ccc; cursor: not-allowed; }
        .footer { text-align: center; padding: 15px 0; position: fixed; bottom: 0; width: 100%; background-color: #0f0377; color: #fff; border-top: 2px solid black; }
        .head { width: 100%; height: 75px; background-color: #0f0377; display: grid; margin: auto; text-align: center; align-items: center; position: fixed; top: 0; left: 0; }
        .head h1 { color: #ffffff; }
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
                    <li><a href="verify.php">Verify</a></li>
                    <li class="active"><a href="problems.php">View Problems</a></li>
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
                                <th>Email</th>
                                <th>View Details</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td><?php echo $row['regNo']; ?></td>
                                    <td><?php echo $row['fullName']; ?></td>
                                    <td></td>
                                    <td>
                                        <a href="response.php?regNo=<?php echo $row['regNo']; ?>">
                                            <button class="btn" type="button">View</button>
                                        </a>
                                    </td>
                                    
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>                        

    <footer class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>                   
    </footer>
</body>
</html>
