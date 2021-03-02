<!DOCTYPE html>
<html>
<head>
	<title>Administrator page</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#userpage {
			height: 64.6vh;
			display: flex;
		}
		#competitions {
			width: 49vw;
			margin-left: 1vw;
			display: grid;
			overflow: auto;
			align-items: center;
			justify-content: center;
			text-align: center;
		}
		#competitions::-webkit-scrollbar {
			width: 1em;
		}
		#competitions::-webkit-scrollbar-track {
  			box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		#competitions::-webkit-scrollbar-thumb {
  			background-color: darkgrey;
  			outline: 1px solid slategrey;
		}
		#competitions h2 {
			cursor: pointer;
		}
		#users {
			width: 50vw;
			display: grid;
			overflow: auto;
			align-items: center;
			justify-content: center;
			text-align: center;
		}
		#users::-webkit-scrollbar {
			width: 1em;
		}
		#users::-webkit-scrollbar-track {
  			box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		#users::-webkit-scrollbar-thumb {
  			background-color: darkgrey;
  			outline: 1px solid slategrey;
		}
		#users h2 {
			cursor: pointer;
		}
		.dropdown {
			display: none;
		}
		table {
			width: 100%;
			border-collapse: collapse;
		}
		th {
			width: 10vw;
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
		td a {
			text-decoration: none;
			color: black;
			padding: 10px;
		}
		td:nth-child(even) a {
			background-color: yellow;
		}
		td:nth-child(odd) a {
			background-color: red;
		}
	</style>
	<script type="text/javascript">
		function dropdown(san) {
			if (document.getElementById("dropdown"+san).style.display=="block") {
				document.getElementById("dropdown"+san).style.display="none";
			} else {
				document.getElementById("dropdown"+san).style.display="block";
			}
		}
	</script>
</head>
<body>
	<?php
	session_start();
	if (isset($_SESSION['user']['name']) and $_SESSION['user']['type'] == "admin") {
		include_once "header.php";
		require_once 'includes/DBconnection/link.php';
   	?>
	<div id="userpage">
	<div id="competitions">
		<h2 onclick="dropdown(1)">Competitions</h2>
		<div class="dropdown" id="dropdown1">
	<?php
	$sql = "SELECT id, name FROM competitions";
	$result = mysqli_query($link,$sql);?>
	<a href="addcompetitionform.php" style="color: blue; text-decoration: none;">Adding a new competition</a>
	<?php
	echo "<table><tr><h3><th>Name</th><th>Mark</th><th>Update</th><th>Delete</th></tr>";
	while($competition = mysqli_fetch_array($result)):?>
		<tr><td><h4><b><?=$competition['name'];?></b></h4></td><td><a href="markcompetition.php?id=<?=$competition['id'];?>">Mark</a></td><td><a href="updatecompetition.php?id=<?=$competition['id'];?>">Update</a></td><td><a href="deletecompetition.php?id=<?=$competition['id'];?>">Delete</a></td></tr>
	<?php endwhile;
	echo "</table>";
	?></div>
	</div>
	<div id="users">
		<h2 onclick="dropdown(2)">Users</h2>
		<div class="dropdown" id="dropdown2">
	<?php
	$sql = "SELECT id, name FROM users";
	$result = mysqli_query($link,$sql);
	echo "<table><tr><h3><th>Name</th><th>Update</th><th>Delete</th></tr>";
	while($user = mysqli_fetch_array($result)):?>
		<tr><td><h4><b><?=$user['name'];?></b></h4></td><td><a href="updateuser.php?id=<?=$user['id'];?>">Update</a></td><td><a href="deleteuser.php?id=<?=$user['id'];?>">Delete</a></td></tr>
	<?php endwhile;
	echo "</table>";
	?></div>
	</div>
	</div>
	<?php include_once "footer.php";
	} else {
		echo "<h1 style='text-align: center;'>Please sign in, do not try to hack the system! :)</h1>";
		header('Refresh: 2; url=index.php');
	}
	?>
</body>
</html>