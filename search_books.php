<?php
session_start();
include "database.php";

// Check if user is logged in
if (!isset($_SESSION["ID"])) {
    header("location:ulogin.php");
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
    <div id="header">
        <center>
            <h1>E-LIBRARY MANAGEMENT SYSTEM</h1>
        </center>
    </div>
    <div id="wrapper">
        <h3 id="heading">SEARCH BOOK</h3>
        <div id="center">
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label>Enter Book Name or Keywords</label>
                <input type="text" name="name" required>
                <button type="submit" name="submit">Search Now</button>
            </form>
        </div>
        <?php
        if (isset($_POST["submit"])) {
            // Sanitize the input to prevent SQL injection
            $name = $db->real_escape_string($_POST["name"]);

            // Search query for books
            $sql = "SELECT * FROM book WHERE BTITLE LIKE '%$name%' OR keywords LIKE '%$name%'";
            $res = $db->query($sql);

            if ($res && $res->num_rows > 0) {
                echo "<table>
                        <tr>
                            <th>SNO</th>
                            <th>BOOK NAME</th>
                            <th>KEYWORDS</th>
                            <th>DOWNLOAD</th>
                            <th>COMMENT</th>
                        </tr>";
                $i = 0;

                // Display books and log downloads
                while ($row = $res->fetch_assoc()) {
                    $i++;
                    $bid = $row["BID"];
                    $id = $_SESSION["ID"];

                    echo "<tr>
                            <td>{$i}</td>
                            <td>{$row["BTITLE"]}</td>
                            <td>{$row["KEYWORDS"]}</td>
                            <td><a href='{$row["FILE"]}' target='_blank'>View & Download</a></td>
                            <td><a href='comment.php?id={$bid}'>Comment</a></td>
                          </tr>";

                    // Insert the download log
                    $log_sql = "INSERT INTO DOWNLOAD (ID, BID, LOGS) 
                                SELECT '$id', '$bid', NOW()
                                WHERE NOT EXISTS (
                                    SELECT * FROM DOWNLOAD WHERE ID = '$id' AND BID = '$bid'
								)";
                    $db->query($log_sql); // Avoid duplicate entries
                }
                echo "</table>";
            } else {
                echo "<p class='error'>No Books Record Found</p>";
            }
        }
        ?>
    </div>
    <div id="navi">
        <?php include "usersidebar.php"; ?>
    </div>
    <div id="footer">
        <center>
            <p>Copyrights &copy; hkrh 2024</p>
        </center>
    </div>
</div>
</body>
</html>