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
    //'Degree Transcript' => "SELECT effectiveDate, status FROM transcript WHERE regNo = '$regNo'",
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
    @import url("https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Montserrat:wght@300;400;500;600;700;800;900&display=swap");


* {
  margin: 0;
  padding: 0;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
  scroll-behavior: smooth;
}
body {
  overflow-x: hidden;
  scroll-behavior: smooth;
  font-family: "Montserrat", sans-serif;
  position: relative;
}
p {
  font-size: 0.8rem;
}
td {
  font-size: 0.8rem;
}
a {
  text-decoration: none;
  color: #111111;
}
a:focus {
  outline: none;
}
.line {
  height: 100%;
  width: 1px;
  background-color: #a3a3a3;
  border: none;
}
.logo {
  font-family: "Kaushan Script", sans-serif;
  color: #233c98;
  font-size: 2rem;
}
.bg-img {
  width: 100vw;
  height: 100vh;
  background: url(BackGroundPic.jpg), lightgray 50% / cover no-repeat;
  -webkit-filter: blur(7.5px);
  -moz-filter: blur(7.5px);
  -o-filter: blur(7.5px);
  -ms-filter: blur(7.5px);
  filter: blur(7.5px);
  position: relative;
  transform: scale(1.05);
}
.login-card {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 55%;
  height: fit-content;
  padding: 30px 10px;
  background-color: white;
  border: none;
  border-radius: 15px;
  box-shadow: 5px 5px 30px rgb(0, 0, 0);
  z-index: 10;
}
.grid-col {
  display: grid;
  grid-template-columns: 49.5% 1% 49.5%;
}
.col {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 85%;
  margin: auto;
}
.col-title {
  font-family: "Kaushan Script", sans-serif;
  color: #233c98;
  font-size: 1.65rem;
}
.icon-bg {
  height: 90px;
  width: 90px;
  background-color: #e1e6fa;
  border: none;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 15px 0;
}
.icon-bg i {
  font-size: 3rem;
  color: #233c98;
  border: none;
  border-radius: 50%;
}
.col .form {
  width: 100%;
  margin: 20px 0;
  display: flex;
  flex-direction: column;
  align-items: center;
}
.text-input {
  display: flex;
  align-items: center;
  width: 250px;
  height: 35px;
  border: 1px solid rgb(199, 199, 199);
  border-radius: 5px;
  margin: 0 0 10px 0;
  border-radius: 8px;
}
.text-input i {
  color: #233c98;
  margin: auto;
}
.text-input input {
  width: 200px;
  height: 100%;
  outline: none;
  border: none;
  background-color: transparent;
  padding-left: 10px;
}

.btn {
  padding: 10px 30px;
  border: none;
  border-radius: 7.5px;
  letter-spacing: 1px;
  margin: 10px;
  cursor: pointer;
  font-size: 0.9rem;
}
.outline-btn {
  background-color: transparent;
  border: 2px solid #233c98;
  color: #233c98;
  transition: 0.4s all ease;
}
.outline-btn:hover {
  background-color: #233c98;
  color: white;
}
.fill-btn {
  background-color: #233c98;
  border: none;
  color: white;
  transition: 0.4s all ease;
}
.footer {
  height: 30px;
  width: 100%;
  text-align: center;
  background-color: #e1e6fa;
  border-top: 1px solid #546cc5;
}
.footer p {
  height: 10px;
  width: 100%;
  font-size: 0.75rem;
  font-weight: bold;
  color: #233c98;
  letter-spacing: 2px;
  padding: 7.5px 0;
}
.card {
  background-color: white;
  border: none;
  border-radius: 15px;
  /* box-shadow: 20px 20px 30px rgba(0, 0, 0, 0.25); */
  width: 100%;
  height: fit-content;
  padding: 40px 15px;
}
.container {
  width: 80%;
  margin: auto;
  margin-bottom: 100px;
  margin-top: 150px;
  
}

.forgot-pw-link {
  color: #233c98;
  font-size: 0.85rem;
  text-decoration: underline;
  letter-spacing: 0.5px;
  line-height: 0.5;
}
.admin-btn {
  position: absolute;
  top: 20px;
  right: 20px;
  z-index: 5;
}
#Dashboard {
  background-color: #f3f8ff;
}

.nav-bar {
  width: 100%;
  height: 15vh;
  background-color: #e1e6fa;
  box-shadow: 5px 5px 20px rgba(35, 60, 152, 0.25);
  position: fixed;
  top: 0;
}
.nav-links {
  height: 100%;
  width: 80%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.profile-card {
  margin-top: 50px;
}
.grid-col-3 {
  display: grid;
  grid-template-columns: 34.5% 1% 64.5%;
  align-items: center;
}
.certificate-title {
  text-align:center;
  margin:40px 0 60px 0;
}
.certificate-details {
  width: 85%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  margin: 0 auto 25px auto;
}
.certificate-details .detail-row-grid2 {
  display: grid;
  grid-template-columns: 45% 55%;
  margin-bottom:25px;
}
.certificate-details .detail-row-grid2 p {
  font-size: 0.8rem;
  font-weight: 500;
}
.certificate-code {
  margin-top:-20px;
  text-align:center;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:5px;
}
.certificate-code .code {
  width:70px;
  padding:7.5px 10px;
  border:1px solid #111;
  border-radius:10px;
}
.profile-picture {
  height: 150px;
  width: 150px;
  border: none;
  border-radius: 50%;
}
.profile {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 85%;
  margin: 0 auto;
}
.profile-bg {
  height: 150px;
  width: 150px;
}
.profile-bg i {
  font-size: 5rem;
}
.profile h4 {
  margin-top: 20px;
  font-size: 1.25rem;
}
.profile p {
  margin-top: 5px;
  font-size: 0.8rem;
}
.profile-details {
  width: 85%;
  height: 100%;
  display: flex;
  flex-direction: column;
  justify-content: space-around;
  margin: 0 auto;
}
.profile-details .detail-row-grid {
  display: grid;
  grid-template-columns: 45% 55%;
}
.profile-details .detail-row-grid p {
  font-size: 0.8rem;
  font-weight: 500;
}
.request-sec,
.progress-sec {
  margin-top: 60px;
}
.topic {
  text-decoration: underline;
  text-align: center;
  font-size: 1.35rem;
  margin-bottom: 25px;
}
.title {
  text-align: center;
  font-size: 1.35rem;
}
.sub-title {
  text-align: center;
  font-size: 1.1rem;
  margin-bottom: 25px;
}
.request-sec table,
.progress-sec table {
  width: 90%;
  margin: 0 auto;
  border-collapse: collapse;
  text-align: left;
}
.request-sec table tr,
.progress-sec table tr {
  height: 50px;
  vertical-align: middle;
  padding-bottom: 15px;
  border-bottom: 1px solid #d1d1d1;
}
.request-sec table th,
.progress-sec table th {
  padding-bottom: 15px;
  border-bottom: 2px solid #a3a3a3;
}
.request-sec table td:nth-child(1),
.progress-sec table td:nth-child(1) {
  width: 15%;
}
.request-sec table td:nth-child(2),
.progress-sec table td:nth-child(2) {
  width: 65%;
}
.request-sec table th:nth-child(3),
.progress-sec table th:nth-child(3) {
  text-align: center;
}
.request-sec table td:nth-child(3),
.progress-sec table td:nth-child(3) {
  width: 20%;
  text-align: center;
  font-weight: 600;
}
.request-sec table tr:last-child,
.progress-sec table tr:last-child {
  border-bottom: none;
}
.success-btn {
  padding: 7.5px 20px;
  background-color: green;
  color: white;
  font-size: 0.7rem;
  font-weight: 600;
}
.pending {
  color: red;
}
.settled {
  color: green;
}
.view-comment {
  color: blue;
}

.complaint-card {
  width: 750px;
  margin: auto;
}
.form-row {
  height: 35px;
  display: grid;
  grid-template-columns: 35% 65%;
  align-items: center;
  margin: 10px 0;
}
.form-row label {
  font-size: 1rem;
  font-weight: 600;
  padding-left: 45px;
}
.form-row:last-child {
  align-items: flex-start;
  margin-top: 15px;
}
.form-row .input {
  height: 100%;
  vertical-align: middle;
  width: 90%;
  outline: none;
  border: 1px solid #a3a3a3;
  border-radius: 7.5px;
  padding-left: 20px;
  font-size: 0.95rem;
}
.form-row textarea {
  height: 100px;
}
.btn-row {
  width: 200px;
  margin: 25px auto 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.btn-row-dashboard {
  width: 900px;
  margin: 100px auto 0;
  display: flex;
  align-items: center;
  justify-content: space-evenly;
}
.row-container {
  width: 70%;
  margin: 0 auto;
}
#certificate-details {
  background-color: #f3f8ff;
}
#certificate-details .form {
  display: flex;
  flex-direction: column;
  align-items: center;
}
#certificate-details .btn {
  font-size: 0.8rem;
}
#certificate-details .form-row {
  grid-template-columns: 40% 60% !important;
  align-items: center;
  margin: 15px 0;
}
#certificate-details .form-row p {
  width: 100%;
  padding: 7.5px 10px;
  border: 1px solid #b1b1b1;
  color: #444;
  border-radius: 7.5px;
}

#complaint_result {
  background-color: #f3f8ff;
}
.complaint-container {
  height: 53vh;
}
.complaint-result-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-around;
  padding-bottom: 20px;
}
.complaint-result-card p {
  margin-bottom: 20px;
}

.gender-dropdown {
  width: 150px;
  height: 90%;
  border: 1px solid #a3a3a3;
  border-radius: 7.5px;
  padding-left: 10px;
  outline: none;
}
.file-input {
  padding-left: 0.5px !important;
}
.file-input::file-selector-button {
  height: 100%;
  width: 100px;
  background-color: #e1e6fa;
  border: none;
  border-right: 1px solid #a3a3a3;
  border-radius: 7.5px 0 0 7.5px;
  font-weight: bold;
  cursor: pointer;
  outline: none;
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
