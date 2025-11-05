<?php
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
				<h1>E-LIBRARY MANAGEMENT SYSTEM</h>
				</center>
			</div>
			<div id="wrapper">
				<h3 id="heading">NEW USER REGISTRATION</h3>
				<div id="center">
				<?php
					if(isset($_POST["submit"]))
					{
							$sql="insert into student(NAME,PASS,MAIL,DEP) values('{$_POST["name"]}','{$_POST["pass"]}',
							'{$_POST["mail"]}','{$_POST["dep"]}')";
							$db->query($sql);
							echo "<p class='success'>Registered Succesfully</p>";
					}
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
						<label>Name</label>
						<input type="text" name="name" required>
						<label>Password</label>
						<input type="pass" name="pass" required>
						<label>E-Mail Id</label>
						<input type="Email" name="mail" required>
						<select name="dep" required>
						<option value="">-select-</option>
						<option value="BCA">BCA</option>
						<option value="B.SC CS">B.SC CS</option>
						<option value="B.SC IT">B.SC IT</option>
						<option value="B.COM CA">B.COM CA</option></select>		
						<button type="submit" name="submit">Register Now</button>
					</form>
				</div>
			</div>
			<div id="navi">
				<?php
					include "sidebar.php";
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