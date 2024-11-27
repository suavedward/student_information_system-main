<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Grades</title>
    <link rel="stylesheet" href="/global.css">
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  </head>
  <body>
    <header class="school-header">
      <div class="logo-container">
        <img
          src="assets/images/user.png"
          alt="School Logo"
          class="school-logo"
        />
      </div>
      <div class="school-info">
        <h1><span class="fas fa-school"></span> School Name</h1>
        <p><span class="fas fa-location-arrow"></span> School Address</p>
        <p><span class="fas fa-phone"></span> School Contact Number</p>
      </div>
    </header>
    <div class="student-container">
      <div class="student-right">
      <ul>
            <li>
              <a href="stud.schedule.php" class="student-btn"
                >Schedule</a
              >
            </li>
            <li>
              <a href="stud.grades.php" class="student-btn">Grades</a>
            </li>
            <li>
              <a href="stud.calendar.php" class="student-btn"
                >Calendar</a
              >
            </li>
          </ul>
          <?php
require_once 'db_connect.php';
$sqlGrades = "
    SELECT 
        strandinfo_tbl.strandname AS strand,
        coursedescription_tbl.coursename,
        grades_tbl.first_quarter,
        grades_tbl.second_quarter,
        grades_tbl.overall_grade,
        CASE 
            WHEN grades_tbl.remarks = 1 THEN 'Pass' 
            ELSE 'Fail' 
        END AS remarks,
        instructorinfo_tbl.insname
    FROM grades_tbl
    JOIN studinfo_tbl ON grades_tbl.LRN = studinfo_tbl.LRN
    JOIN strandinfo_tbl ON studinfo_tbl.strandid = strandinfo_tbl.strandid
    JOIN coursedescription_tbl ON grades_tbl.course_id = coursedescription_tbl.courseid
    JOIN instructorinfo_tbl ON grades_tbl.instructorid = instructorinfo_tbl.instructorid
    WHERE studinfo_tbl.LRN = 'LRN'";

$resultGrades = $conn->query($sqlGrades);
?>

<table class="stud-grades" border="1">
    <tr>
        <th>STRAND</th>
        <th colspan="5">
            <?php 

            if ($resultGrades && $row = $resultGrades->fetch_assoc()) {
                echo htmlspecialchars($row['strand'] ?? 'N/A');
                $resultGrades->data_seek(0); 
            } else {
                echo 'N/A';
            }
            ?>
        </th>
    </tr>
    <tr>
        <th>Subject</th>
        <th>First Quarter</th>
        <th>Second Quarter</th>
        <th>Overall Grade</th>
        <th>Remarks</th>
        <th>Instructor Name</th>
    </tr>
    <?php 
    if ($resultGrades && $resultGrades->num_rows > 0) {
        while ($row = $resultGrades->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['coursename'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['first_quarter'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['second_quarter'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['overall_grade'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['remarks'] ?? 'N/A') . "</td>";
            echo "<td>" . htmlspecialchars($row['insname'] ?? 'N/A') . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='6'>No grades found.</td></tr>";
    }
    ?>
</table>

      </div>
      <div class="student-left">
        <div class="student-box">
        <h1>Personal Information</h1>
<?php
require_once 'db_connect.php';


$sqlPersonalData = "SELECT firstname, middlename, lastname, extension, LRN, studAge, gender, birthplace, birthDate, studaddress, contactNum, strandid, sectionid,
guardian_firstname,guardian_middlename, guardian_lastname, guardian_extension, guardiancontact, guardianaddress, relationship FROM studinfo_tbl LIMIT 1";
$resultPersonal = $conn->query($sqlPersonalData);


if ($resultPersonal->num_rows > 0) {
    $personalData = $resultPersonal->fetch_assoc();
} else {
    $personalData = null;
}

?>
    <table border="1">
        <tr>
            <th>PERSONAL DATA</th>
        </tr>
        <tr>
            <td><strong>LRN:</strong> <?php echo htmlspecialchars($personalData['LRN'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
    <td><strong>Name:</strong> 
<?php 
        echo htmlspecialchars(
            ($personalData['firstname'] ?? '') . ' ' .
            ($personalData['middlename'] ?? '') . ' ' .
            ($personalData['lastname'] ?? '') . ' ' .
            ($personalData['extension'] ?? '')
        ); 
?>
    </td>
</tr>

        <tr>
            <td><strong>Age:</strong> <?php echo htmlspecialchars($personalData['studAge'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Gender:</strong> <?php echo htmlspecialchars($personalData['gender'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Date of Birth:</strong> <?php echo htmlspecialchars($personalData['birthplace'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Place of Birth:</strong> <?php echo htmlspecialchars($personalData['birthDate'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Address:</strong> <?php echo htmlspecialchars($personalData['studaddress'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Contact Number:</strong> <?php echo htmlspecialchars($personalData['contactNum'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Section:</strong> <?php echo htmlspecialchars($personalData['sectionid'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Strand:</strong> <?php echo htmlspecialchars($personalData['strandid'] ?? 'N/A'); ?></td>
        </tr>
    </table>

    <br />

    <!-- Emergency Contact Table -->
    <table border="1">
        <tr>
            <th>PERSON TO CONTACT IN CASE OF EMERGENCY</th>
        </tr>
        <td><strong>Name:</strong> 
<?php 
        echo htmlspecialchars(
            ($personalData['guardian_firstname'] ?? '') . ' ' .
            ($personalData['guardian_middlename'] ?? '') . ' ' .
            ($personalData['guardian_lastname'] ?? '') . ' ' .
            ($personalData['guardian_extension'] ?? '')
        ); 
?>
    </td>
        <tr>
            <td><strong>Contact Number:</strong> <?php echo htmlspecialchars($personalData['guardiancontact'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Address:</strong> <?php echo htmlspecialchars($personalData['guardianaddress'] ?? 'N/A'); ?></td>
        </tr>
        <tr>
            <td><strong>Relationship:</strong> <?php echo htmlspecialchars($personalData['relationship'] ?? 'N/A'); ?></td>
        </tr>
    </table>
          <ul>
            <li>
              <a href="login_as.html" class="sign-out-btn" id="sign-out">
                Sign Out
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <script src="assets/js/global.js"></script>
  </body>
</html>
