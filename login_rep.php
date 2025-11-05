<?php
    session_start();
    include "database.php";

    // Redirect to admin login if the session is not set
    if (!isset($_SESSION["AID"])) {
        header("location:alogin.php");
        exit();
    }
?>
<!DOCTYPE HTML>
<html>
<head>
    <title>E-LIBRARY MANAGEMENT SYSTEM</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div id="container">
        <!-- Header Section -->
        <div id="header">
            <center>
                <h1>E-LIBRARY MANAGEMENT SYSTEM</h1>
            </center>
        </div>

        <!-- Main Content Section -->
        <div id="wrapper">
            <h3 id="heading">VIEW STUDENT LOGIN REPORTS</h3>
            <?php
                // SQL query to fetch login reports
                $sql = "SELECT login.id AS log_id, student.name AS student_name, login.logs
                        FROM login
                        INNER JOIN student ON login.sid = student.id
						ORDER BY LOGIN.LOGS DESC";

                // Execute the query
                $res = $db->query($sql);

                // Check if results exist
                if ($res && $res->num_rows > 0) {
                    echo "<table>
                        <tr>
                            <th>SNO</th>
                            <th>STUDENT NAME</th>
                            <th>LOGS</th>
                        </tr>";

                    $i = 0;
                    while ($row = $res->fetch_assoc()) {
                        $i++;
                        echo "<tr>
                                <td>{$i}</td>
                                <td>{$row['student_name']}</td>
                                <td>{$row['logs']}</td>
                              </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p class='error'>No Login Record Found</p>";
                }
            ?>
        </div>

        <!-- Sidebar Section -->
        <div id="navi">
            <?php include "adminsidebar.php"; ?>
        </div>

        <!-- Footer Section -->
        <div id="footer">
            <center>
                <p>Copyrights &copy; hkrh 2024</p>
            </center>
        </div>
    </div>
</body>
</html>