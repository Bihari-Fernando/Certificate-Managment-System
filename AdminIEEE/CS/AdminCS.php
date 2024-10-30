<?php
session_start();
include "connect.php";

// Handle the verification request
if (isset($_POST['verify'])) {
    $regNo = $_POST['regNo'];

    // Update query to set status to 'V' (Verified)
    $updateQuery = "UPDATE cs SET status = 'V' WHERE regNo = '$regNo'";
    if (mysqli_query($con, $updateQuery)) {
        echo "<script>alert('Student verified successfully!');</script>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
}

// Fetch all student data from the topstudents table
$query = "SELECT * FROM cs";
$result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IEEE Computer Society</title>
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
            background-color: #04AA6D;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
        }

        .btn:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>IEEE Computer Society</h2>
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

    <div class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
    </div>
</body>
</html>
