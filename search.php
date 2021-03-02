<!DOCTYPE html>
<html>
<head>
	<title>Search page</title>
	<link rel="shortcut icon" type="image/x-icon" href="logo.ico">
	<style type="text/css">
		#searchresult {
			min-height: 64vh;
			overflow: auto;
		}
		table {
			margin: 20px;
			border-collapse: collapse;
		}
		th {
			padding: 5px;
			background-color:  #7dccff;
			text-align: center;
			border: 2px solid black;
			border-collapse: collapse;
		}
		td {
			padding: 5px;
			text-align: center;
			border: 2px solid black;
			border-collapse: collapse;
		}
	</style>
</head>
<body>
	<?php include_once "header.php"?>
	<div id="searchresult">
		<?php
		require_once "includes/DBconnection/link.php";
		mysqli_query($link, "SET NAMES 'UTF8'");
		$search = $_POST["search"];
		$sql = "SELECT * FROM competitions WHERE name LIKE '%$search%'";
		$result = mysqli_query($link,$sql);
		$num = mysqli_num_rows($result);
		if ($num==0) {
	    	echo "<h2><center>Nothing was found for the query '$search'!</center></h2>";
		} else {
			echo "<table><tr><th><h3>Name</h3></th><th><h3>Description</h3></th><th><h3>Status</h3></th></tr>";
			while($competitions = mysqli_fetch_array($result)) {
			echo "<tr><td><h4><b>{$competitions['name']}</b></h4></td><td>{$competitions['description']}</td><td>{$competitions['status']}</td></tr>";
			}
			echo "</table>";
		}
		?>
	</div>
	<?php include_once "footer.php"?>
</body>
</html>