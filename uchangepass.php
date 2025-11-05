<?php
	session_start();
	include "database.php";
	if(!isset($_SESSION["ID"]))
	{
		header("location:ulogin.php");
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
				<h1>E-LIBRARY MANAGEMENT SYSTEM</h>
				</center>
			</div>
			<div id="wrapper">
				<h3 id="heading">USER CHANGE PASSWORD</h3>
				<div id="center">
				<?php
					if(isset($_POST["submit"]))
					{
						$sql="SELECT * FROM STUDENT WHERE PASS='{$_POST["opass"]}' and ID='{$_SESSION["ID"]}'";
						$res=$db->query($sql);
						if($res->num_rows>0)
						{
							$s="update student set PASS='{$_POST["npass"]}' WHERE ID=".$_SESSION["ID"];
							$db->query($s);
							echo "<p class='success'>Password Changed Success</p>";
						}
						else
						{
							echo "<p class='error'>Invalid Password</p>";
						}
					}
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
						<label>Old Password</label>
						<input type="password" name="opass" required>
						<label>New Password</label>
						<input type="password" name="npass" required>
						<button type="submit" name="submit">Update Pass</button>
					</form>
				</div>
			</div>
			<div id="navi">
				<?php
					include "usersidebar.php";
				?>
			</div>
			<div id="footer">
				<center>
				<p>Copyrights &copy;hkrh 2024</p>
				</center>
			</div>
		</div>
	</body>
</html>