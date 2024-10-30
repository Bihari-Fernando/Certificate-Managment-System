<?php
ob_start();
session_start();
include "connect.php";

$regNo = $_SESSION['username'];

// Fetch student details
$query = "SELECT * FROM students WHERE regNo = '$regNo'";
$res = mysqli_query($con, $query);
$obj = mysqli_fetch_assoc($res);

// Check for inquiries
if (isset($_POST['regno'])) {
    $sql = "SELECT * FROM problems WHERE regNo = '$regNo'";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) == 1) {
        echo "<script>alert('You can\'t file a new inquiry.')</script>";
    } else {
        header("location: Request.php");
        exit();
    }
}

// Define queries for certificates
$queries = [
    'Top Graded Student Certificate' => "SELECT effectiveDate, status FROM topstudents WHERE regNo = '$regNo'",
    'Internship Certificate' => "SELECT effectiveDate, status FROM internship WHERE regNo = '$regNo'",
    'IEEE CS Session Certificate' => "SELECT effectiveDate, status FROM cs WHERE regNo = '$regNo'",
    'IEEE CIS Session Certificate' => "SELECT effectiveDate, status FROM cis WHERE regNo = '$regNo'",
    'IEEE WIE Session Certificate' => "SELECT effectiveDate, status FROM wie WHERE regNo = '$regNo'",
    //'Degree Transcript Certificate' => "SELECT effectiveDate, status FROM transcript WHERE regNo = '$regNo'",
];

// Store certificate results
$certificates = [];
foreach ($queries as $type => $query) {
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Query failed: " . mysqli_error($con));
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $certificates[] = [
            'type' => $type,
            'effectiveDate' => $row['effectiveDate'] ?? 'N/A',
            'status' => $row['status'] ?? 'N/A'
        ];
    }
}

// Download links for certificates
$downloadLinks = [
    'Top Graded Student Certificate' => 'TopGraded/download_top_student_certificate.php',
    'IEEE CIS Session Certificate' => 'IEEE/chapters/CIS_download.php',
    'IEEE CS Session Certificate' => 'IEEE/chapters/CS_download.php',
    'IEEE WIE Session Certificate' => 'IEEE/chapters/WIE_download.php',
    'Transcript Certificate' => 'Transcript/download_transcript.php',
    'Internship Certificate' => 'Internship/download_internship.php'
];


$responseQuery = "SELECT * FROM internship WHERE regNo = '$regNo'";
$responseResult = mysqli_query($con, $responseQuery);
$responses = [];
while ($responseRow = mysqli_fetch_assoc($responseResult)) {
    $responses[] = $responseRow;
}

$details = [
    'Top Graded Student Certificate' => "SELECT problems, problem_status FROM topstudents WHERE regNo = '$regNo'",
    'Internship Certificate' => "SELECT problems, problem_status FROM internship WHERE regNo = '$regNo'",
    //'IEEE CS Session Certificate' => "SELECT problems, problem_status FROM cs WHERE regNo = '$regNo'",
    //'IEEE CIS Session Certificate' => "SELECT problems, problem_status FROM cis WHERE regNo = '$regNo'",
    //'IEEE WIE Session Certificate' => "SELECT problems, problem_status FROM wie WHERE regNo = '$regNo'",
    //'Degree Transcript Certificate' => "SELECT problems, problem_status FROM cs WHERE regNo = '$regNo'",
];

// Store certificate results
$problems = [];
foreach ($details as $type => $detail) {
    $res = mysqli_query($con, $detail);
    if (!$res) {
        die("Query failed: " . mysqli_error($con));
    }
    while ($row = mysqli_fetch_assoc($res)) {
        $problems[] = [
            'type' => $type,
            'problems' => $row['problems'] ?? 'N/A',
            'problem_status' => $row['problem_status'] ?? 'N/A'
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer">

    <style>
   
    
    .nav-links a {
        float: left;
        color: #f2f2f2;
        text-align: center;
        padding: 8px 15px; /* Adjust padding to reduce height */
        text-decoration: none;
        font-size: 16px; /* Adjust font size if necessary */
    }
    
    .nav-bar .nav-links a:hover {
        background-color: #ddd;
        color: black;
    }
    
    .nav-bar .nav-links .active {
        background-color: #04AA6D;
        color: white;
    }
    
    .container {
        margin: 20px;
    }
    
    .footer {
        text-align: center;
        margin-top: 30px;
    }
    .navdiv{
        background-color: #233c98;
        overflow: hidden;
        padding-top: 20px;
        padding-bottom: 20px;
        
    }
</style>

</head>

<body id="Dashboard">
    <div class="navdiv">
    
        <div class="nav-links">
            <a href="dashboard.php" class="active">Dashboard</a>
            <a href="IEEE/IEEEcertificate.php">IEEE Certificates</a>
            <a href="TopGraded/requested_top_student_certificates.php">Top Graded Student Certificates</a>
            <a href="Internship/internship_certificate.php">Internship Certificates</a>
            <a href="Transcript/transcript.php">Transcript</a>
            <a href="logout.php">Logout</a>
        </div>
    
    </div>
   

    <div class="container">
        <div class="card profile-card">
            <div class="grid-col-3">
                <div class="profile">
                    <div class="icon-bg profile-bg">
                        <i class="fa-solid fa-user"></i>
                    </div>
                    <h4><?php echo htmlspecialchars($obj['fullName']); ?></h4>
                    <p><?php echo htmlspecialchars($obj['regNo']); ?></p>
                </div>
                <div class="line"></div>
                <div class="profile-details">
                    <div class="detail-row-grid"><h5>Current Level:</h5><p><?php echo htmlspecialchars($obj['currentLevel']); ?></p></div>
                    <div class="detail-row-grid"><h5>Batch No:</h5><p><?php echo htmlspecialchars($obj['batchNo']); ?></p></div>
                    <div class="detail-row-grid"><h5>Registration No:</h5><p><?php echo htmlspecialchars($obj['regNo']); ?></p></div>
                    <div class="detail-row-grid"><h5>Index No:</h5><p><?php echo htmlspecialchars($obj['indexNo']); ?></p></div>
                    <div class="detail-row-grid"><h5>NIC:</h5><p><?php echo htmlspecialchars($obj['nic']); ?></p></div>
                    <div class="detail-row-grid"><h5>Gender:</h5><p><?php echo htmlspecialchars($obj['gender']); ?></p></div>
                    <div class="detail-row-grid"><h5>Email:</h5><p><?php echo htmlspecialchars($obj['email']); ?></p></div>
                    <div class="detail-row-grid"><h5>Mobile Number:</h5><p><?php echo htmlspecialchars($obj['contactNo']); ?></p></div>
                    <div class="detail-row-grid"><h5>Address:</h5><p><?php echo htmlspecialchars($obj['address']); ?></p></div>
                    <div class="detail-row-grid"><h5>Study Program:</h5><p><?php echo htmlspecialchars($obj['studyProgram']); ?></p></div>
                    <div class="detail-row-grid"><h5>Date of Admission:</h5><p><?php echo htmlspecialchars($obj['admissionDate']); ?></p></div>
                </div>
            </div>
        </div>

        <div class="card request-sec">
            <h3 class="topic">Certificate Request Progress</h3>
            <table>
                <thead>
                    <tr>
                        <th>Certificate Type</th>
                        <th>Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($certificates as $certificate): ?>
                    <?php if (!empty($certificate['effectiveDate']) && $certificate['effectiveDate'] !== '0000-00-00'): ?>
                  <tr>
                    <td><?php echo htmlspecialchars($certificate['type']); ?></td>
                    <td><?php echo htmlspecialchars($certificate['effectiveDate']); ?></td>
                    <td>
                        <?php if ($certificate['status'] == 'V'): ?>
                            <a href="<?php echo $downloadLinks[$certificate['type']] . '?regNo=' . urlencode($regNo); ?>" class="btn fill-btn">
                                Download
                            </a>
                        <?php else: ?>
                            Requested
                        <?php endif; ?>
                    </td>
                  </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- New section for viewing admin responses -->
        <div class="card request-sec">
    <h3 class="topic">Your Submitted Problems and Responses</h3>
    <table>
        <thead>
            <tr>
                <th>Problem Type</th>
                <th>Problem Description</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($problems as $problem): ?>
            <tr>
                <td><?php echo htmlspecialchars($problem['type']); ?></td>
                <td><?php echo htmlspecialchars($problem['problems']); ?></td>
                
                <td>
                    <?php if ($problem['problem_status'] == 'V'): ?>
                        <a href="Internship/view_response.php" class="btn fill-btn">
                            View
                        </a>
                    <?php else: ?>
                        <span>In Progress</span>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>




        
    </div>

    <div class="footer">
        <p>COPYRIGHT &copy; 2023 FACULTY OF SCIENCE UNIVERSITY OF JAFFNA. ALL RIGHTS RESERVED.</p>
    </div>

    <script>
        function req(reg) {
            var frm = document.createElement("form");
            frm.action = "";
            frm.method = "post";

            var inp = document.createElement("input");
            inp.name = "regno";
            inp.value = reg;

            frm.appendChild(inp);
            document.body.appendChild(frm);
            frm.submit();
        }
    </script>
</body>
</html>
