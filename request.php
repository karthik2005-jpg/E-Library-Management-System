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
				<h3 id="heading">NEW BOOK REQUEST</h3>
				<div id="center">
				<?php
					if(isset($_POST["submit"]))
					{
						$sql="insert into request(ID,MES,LOGS) values('{$_SESSION["ID"]}','{$_POST["mess"]}',now());";
						$res=$db->query($sql);
						echo "<p class='success'>Request Send Successfully</p>";
					
					}
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
						<label>Message</label>
						<textarea required name="mess"></textarea>
						<button type="submit" name="submit">Sent Request</button>
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