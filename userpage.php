<!DOCTYPE html>
<html>
<head>
	<title>User page</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#userpage {
			height: 64.6vh;
			display: flex;
		}
		#rate {
			display: grid;
			width: 50vw;
			overflow: auto;
			align-items: center;
			text-align: center;
		}
		#rate::-webkit-scrollbar {
			width: 1em;
		}
		#rate::-webkit-scrollbar-track {
  			box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		#rate::-webkit-scrollbar-thumb {
  			background-color: darkgrey;
  			outline: 1px solid slategrey;
		}
		#rate h2 {
			cursor: pointer;
		}
		.dropdown {
			display: none;
		}
		table {
			margin-left: 10%;
			width: 80%;
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
		#info {
			width: 50vw;
			display: grid;
			align-items: baseline;
			justify-content: center;
		}
		.line {
			text-align: left;
			display: flex;
			margin-top: -20px;
		}
		.line form {
			display: grid;
		}
		.line form input[type=password] {
			padding: 5px;
			margin: 5px;
			width: 250px;
		}
		.line form input[type=submit] {
			padding: 5px;
			background-color: #059bfc;
			border: 2px solid #059bfc;
		}
		.line form input[type=submit]:hover {
			color: white;
			cursor: pointer;
		}
		.text {
			width: 100px;
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#changePasswordForm").submit(function() {
				event.preventDefault();
                var password = $("#password").val();
                var newpassword = $("#newpassword").val();
                var confirmpassword = $("#confirmpassword").val();
                if (newpassword == confirmpassword) {
                	$.ajax({
	                	url: 'includes/changepassword.php',
	                    type: 'POST',
	                    data: {
	                        password: password,
	                        newpassword: newpassword,
	                        confirmpassword: confirmpassword
	                    },
	                    cache: false,
	                    success: function (data) {
	                        var data = JSON.parse(data);
	                        if (data.statusCode == 200) {
	                        	$("#changePasswordForm").each(function() {
	                        		this.reset();
	                        	});
	                            alert("You have successfully changed your password!");
	                        } else if (data.statusCode == 201) {
	                            alert("Error occured!");
	                        } else if (data.statusCode == 202) {
	                        	alert("Current password is incorrect!");
	                        }
	                    }
	                });
                } else {
                	alert("Different passwords!");
                }
			});
		});
	</script>
</head>
<body>
	<?php
	session_start();
	if (isset($_SESSION['user']['name']) and $_SESSION['user']['type'] == "user") {
	include_once "header.php";
   	?>
	<div id="userpage">
	<div id="rate">
		<h2 onclick="dropdown(1)">Participated competitions</h2>
		<div class="dropdown" id="dropdown1">
	<?php require_once "includes/DBconnection/link.php";
	$sql = "SELECT mark, category, competitions.name as compname FROM participants JOIN competitions on participants.competition_id = competitions.id WHERE user_name = '".$_SESSION['user']['name']."'";
	$result = mysqli_query($link,$sql);
	$num = mysqli_num_rows($result);
	if ($num==0) {
    	echo "<h2><center>You haven't participated in competitions!</center></h2>";
	} else {
		echo "<table><tr><th><h3>Name</h3></th><th><h3>Category</h3></th><th><h3>Mark</h3></th></tr>";
		while($participant = mysqli_fetch_array($result)) {
		echo "<tr><td><h4><b>{$participant['compname']}</b></h4></td><td>{$participant['category']}</td><td>{$participant['mark']}</td></tr>";
		}
		echo "</table>";
	}
	?></div>
	</div>
		<div id="info">
			<h2>Personal information</h2>
			<?php
		$sql = "SELECT * FROM users WHERE name = '".$_SESSION['user']['name']."'";
		$result = mysqli_query($link,$sql);
		$info = mysqli_fetch_assoc($result);?>
			<div class='line'><div class='text'>Name:</div><label id="SessionName"><?=$info['name'];?></label></div>
			<div class='line'><div class='text'>Email:</div><label><?=$info['email'];?></label></div>
			<div class='line'><div class='text'>Age:</div><label><?=$info['age'];?></label></div>
			<div class='line'>
				<form id='changePasswordForm'>
					<input type='password' id='password' placeholder='Current password' required='required'>
					<input type='password' id='newpassword' placeholder='New password' required='required'>
					<input type='password' id='confirmpassword' placeholder='Confirm new password' required='required'>
					<input type='submit' value='Change password'>
				</form>
			</div>
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