 <?php
	session_start();
	include "database.php";
	function countRecord($sql,$db)
	{
		$res=$db->query($sql);
		return $res->num_rows;
	}
	
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
				<h3 id="heading">WELCOME ADMIN</h3>
				<center><h4 id="heading"> <?php $current_date = date("l, d F Y"); echo $current_date;?></h4></center>
				<center>
						<h4 id="heading"><?php date_default_timezone_set('Asia/Kolkata'); $current_time = date("H:i:s"); echo $current_time;?></h4>
				</center>
				<div id="center">
					<ul class="record">
					<li>Total Students	:<?php echo countRecord("select * from student",$db);?></li>
					<li>Total Books		:<?php echo countRecord("select * from book",$db);?></li>
					<li>Total Request	:<?php echo countRecord("select * from request",$db);?></li>
					<li>Total Comments	:<?php echo countRecord("select * from comment",$db);?></li>
					</ul>
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