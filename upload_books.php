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
				<h3 id="heading">UPLOAD BOOKS</h3>
				<div id="center">
				<?php
					if(isset($_POST["submit"]))
					{
						$target_dir="upload/";
						$target_file=$target_dir.basename($_FILES["efile"]["name"]);
						if(move_uploaded_file($_FILES["efile"]["tmp_name"],$target_file))
						{
							$sql="insert into book(BTITLE,KEYWORDS,FILE) values('{$_POST["bname"]}','{$_POST["keys"]}','{$target_file}')";
							$db->query($sql);
							echo "<p class='success'>Book Uploaded Succesfully</p>";
						}
						else
						{
							echo "<p class='error'>Error In Upload</p>";
						}
					}
				?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" enctype="multipart/form-data">
						<label>Book Title</label>
						<input type="text" name="bname" required>
						<label>KeyWords</label>
						<textarea name="keys" required></textarea>
						<label>Upload File</label>
						<input type="file" name="efile" required>
						<button type="submit" name="submit">Upload Books</button>
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