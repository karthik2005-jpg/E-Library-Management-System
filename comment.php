<?php
session_start();
include "database.php";
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
            <h3 id="heading">SEND YOUR COMMENTS</h3>
            <?php
            // Fetch book details
            if (isset($_GET["id"]) && is_numeric($_GET["id"])) {
                $stmt = $db->prepare("SELECT * FROM book WHERE BID = ?");
                $stmt->bind_param("i", $_GET["id"]);
                $stmt->execute();
                $res = $stmt->get_result();
                if ($res->num_rows > 0) {
                    $row = $res->fetch_assoc();
                    echo "<table>
                            <tr>
                                <th>Book Name</th>
                                <td>{$row["BTITLE"]}</td>
                            </tr>
                            <tr>
                                <th>Keywords</th>
                                <td>{$row["KEYWORDS"]}</td>
                            </tr>
                          </table>";
                } else {
                    echo "<p class='error'>No Books Found</p>";
                }
                $stmt->close();
            } else {
                echo "<p class='error'>Invalid Book ID</p>";
            }
            ?>
            <div id="center">
                <!-- Comment Form -->
                <form method="post" action="">
                    <label>Your Comments</label>
                    <input type="text" name="mes" required>
                    <button type="submit" name="submit">Post Now</button>
                </form>
                <?php
                if (isset($_POST["submit"]) && !empty($_POST["mes"])) {
                    $comment = htmlspecialchars($_POST["mes"]);
                    $stmt = $db->prepare("INSERT INTO comment (BID, SID, COMM, LOGS) VALUES (?, ?, ?, NOW())");
                    $stmt->bind_param("iis", $_GET["id"], $_SESSION["ID"], $comment);
                    if ($stmt->execute()) {
                        echo "<p class='success'>Comment Posted Successfully</p>";
                    } else {
                        echo "<p class='error'>Failed to Post Comment</p>";
                    }
                    $stmt->close();
                }
                ?>
            </div>
            <?php
            // Fetch and display comments
            $stmt = $db->prepare("
                SELECT student.NAME, comment.COMM, comment.LOGS 
                FROM comment 
                INNER JOIN student ON comment.SID = student.ID 
                WHERE comment.BID = ? 
                ORDER BY comment.CID DESC
            ");
            $stmt->bind_param("i", $_GET["id"]);
            $stmt->execute();
            $res = $stmt->get_result();
            if ($res->num_rows > 0) {
                while ($row = $res->fetch_assoc()) {
                    echo "<p><strong>{$row["NAME"]}:</strong>: {$row["COMM"]} <i>{$row["LOGS"]}</i></p>";
                }
            } else {
                echo "<p class='error'>No Comments Yet...</p>";
            }
            $stmt->close();
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