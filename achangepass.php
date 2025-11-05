<?php
	session_start();
	include "database.php";
	if(!isset($_SESSION["AID"]))
	{
		header("location:alogin.php");
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
				<h3 id="heading">CHANGE PASSWORD</h3>
				<div id="center">
				<?php
					if(isset($_POST["submit"]))
					{
						$sql="SELECT * FROM ADMIN WHERE APASS='{$_POST["opass"]}' and AID='{$_SESSION["AID"]}'";
						$res=$db->query($sql);
						if($res->num_rows>0)
						{
							$s="update admin set APASS='{$_POST["npass"]}' WHERE AID=".$_SESSION["AID"];
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
					include "adminsidebar.php";
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