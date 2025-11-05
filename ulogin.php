<?php  
session_start(); 
include "database.php"; 
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
            <h3 id="heading">USER LOGIN HERE...</h3>
            <div id="center">
                <?php
                    if (isset($_POST["submit"])) {
                        // Use prepared statements to prevent SQL Injection
                        $name = $_POST["name"];
                        $pass = $_POST["pass"];
                        
                        // Query to check if the user exists
                        $stmt = $db->prepare("SELECT * FROM student WHERE NAME = ? AND PASS = ?");
                        $stmt->bind_param("ss", $name, $pass);
                        $stmt->execute();
                        $result = $stmt->get_result();
                        
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            
                            // Initialize session variables
                            $_SESSION["ID"] = $row["ID"];
                            $_SESSION["NAME"] = $row["NAME"];
                            
                            // Insert login record (to track the login activity)
                            $login_stmt = $db->prepare("INSERT INTO LOGIN (sid, logs) VALUES (?, NOW())");
                            $login_stmt->bind_param("i", $_SESSION["ID"]);
                            $login_stmt->execute();
                            
                            header("location: uhome.php");
                        } else {
                            echo "<p class='error'>Invalid username or password.</p>";
                        }
                    }
                ?>
                <form action="ulogin.php" method="post">
                    <label>User Name:</label>
                    <input type="text" name="name" required>
                    <label>Password:</label>
                    <input type="password" name="pass" required>
                    <button type="submit" name="submit">Login Now</button>
                </form>
            </div>
        </div>

        <div id="navi">
            <?php include "sidebar.php"; ?>
        </div>

        <div id="footer">
            <center>
                <p>Copyrights &copy;hkrh 2024</p>
            </center>
        </div>
    </div>
</body>
</html>