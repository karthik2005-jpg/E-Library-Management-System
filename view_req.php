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
				<h3 id="heading">VIEW REQUEST DETAILS</h3>
				<?php
					$sql="SELECT STUDENT.NAME,REQUEST.MES,REQUEST.LOGS FROM STUDENT INNER JOIN REQUEST ON STUDENT.ID=REQUEST.ID";
					$res=$db->query($sql);
					if($res->num_rows>0)
					{
						echo "<table>
							<tr>
								<th>SNO</th>
								<th>STUDENT NAME</th>
								<th>MEESAGE</th>
								<th>LOGS</th>
							</tr>";
								$i=0;
							while($row=$res->fetch_assoc())
							{
								$i++;
								echo "<tr>";
								echo "<td>{$i}</td>";
								echo "<td>{$row["NAME"]}</td>";
								echo "<td>{$row["MES"]}</td>";
								echo "<td>{$row["LOGS"]}</td>";
								echo "</tr>";
								
							}
							
							echo "</table>";
					}
					else
					{
						echo "<p class='error'>No Request Record Found</p>";
					}
				?>	
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