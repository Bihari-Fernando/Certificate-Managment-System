<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problems</title>


    <link rel="stylesheet" href="style/mainupdate.css?=<?php echo time(); ?> ">
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
                <li><a href="managerequest.php">Manage Request</a></li>
                <li ><a href="viewsearch.php">View and Search</a></li>
                <li class="active"><a href="viewproblems.php">View Problems</a></li>
                <li ><a href="viewcomplains.php">View Complains</a></li>

                <li ><a href="logout.php">Log Out</a></li>
            </ul>
        </div><!--verticalnavi-->
        <div class="mainbox">
            <div class="updatebox">
                 <!-- <div class="searchupdate">  -->
                    <form class="searchform" action="">
                        <!-- <input type="text" placeholder="Search..(2020XXX000)" name="search"> -->
                        <?php
                            // Database configuration
                            ob_start();
                            include "connect.php";
                            session_start();

                                // Check if the user is not logged in
                            if (!isset($_SESSION["username"]) ) {
                                    header("Location: ../Adminlogin.php"); // Redirect to the login page if not logged in as an admin
                                    exit();
                                }


                            // Initialize variables for pagination
                            $results_per_page = 20;
                            $page = isset($_GET['page']) ? $_GET['page'] : 1;

                            // Get search query
                            $search_query = isset($_GET['search']) ? $_GET['search'] : '';

                            // Create a WHERE clause for the search
                            $search_conditions = [];
                            if (!empty($search_query)) {
                                $search_conditions[] = "regNo LIKE '%$search_query%' OR name LIKE '%$search_query%' ";
                            }

                            // Build the SQL query
                            $sql = "SELECT * FROM problems";
                            if (!empty($search_conditions)) {
                                $sql .= " WHERE " . implode(" OR ", $search_conditions);
                            }

                            // Get total number of records
                            $result = $conn->query($sql);
                            $total_records = $result->num_rows;

                            // Calculate the number of pages
                            $total_pages = ceil($total_records / $results_per_page);

                            // Calculate the SQL LIMIT clause
                            $offset = ($page - 1) * $results_per_page;
                            $sql .= " LIMIT $offset, $results_per_page";

                            // Execute the final SQL query
                            $result = $conn->query($sql);

                            // Display search form
                            echo '<div class = "search">';
                            echo '<form method="GET" action="">';
                            echo ' <input type="text" name="search" value="' . htmlentities($search_query) . '">';
                            echo '<button id = "searchBtn" type="submit"  name="searchBtn" >Search<button>';
                            echo '</form>';
                            echo '</div>';


                            ?>

                            
<table>
                            <tr><th>Reg No</th><th>Index No</th><th>Full Name</th><th>Action</th></tr>
                            <?php while ($row = $result->fetch_assoc()) { ?>
                                <tr>
                                <td> <?php echo $row['regNo']  ?> </td>
                                <td><?php echo $row['name']  ?></td>
                                <td><?php echo $row['nic']  ?></td>
                                
                                <td><a href="subproblems.php?regNo=<?php echo $row['regNo'] ?>"><button id = "updateButton">View<button></a> </td>
                                </tr>
                            <?php } ?>
                            </table>

                            <?php

                            // Display pagination links
                            echo '<div class="pagination">';
                            for ($i = 1; $i <= $total_pages; $i++) {
                                echo '<a href="viewproblems.php?page=' . $i . '&search=' . htmlentities($search_query) . '">' . $i . '</a>';
                            }
                            echo '</div>';

                            // Close the database connection
                            $conn->close();
                            ?>

                         <button type="submit" name="searchBtn" value="Search"></button> 
                    </form>
                <!-- </div>searchupdate -->
            </div>
        </div><!--mainbox-->


    </div><!--maincontent-->

</body>

</html>