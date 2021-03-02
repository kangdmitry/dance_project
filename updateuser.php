<!DOCTYPE html>
<html>
<head>
	<title>Update user</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#signup {
			margin-top: 20px;
			height: 64vh;
		}
		#updateUserForm {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
		}
		#updateUserForm fieldset {
			padding: 20px;
			border-color: #7dccff;
		}
		#updateUserForm fieldset legend {
			font-size: 25px;
		}
		#line {
			margin-left: 1vw;
			font-size: 15px;
		}
		#line input {
			font-size: 15px;
			margin: 5px 5px;
			padding: 5px;
			width: 30vw;
		}
		#line input[type=submit] {
			background-color: #7bf02d;
			border-color: #7bf02d;
			width: 31vw;
		}
		form img {
			margin-bottom: -20px;
		}
		textarea {
			resize: vertical;
			padding: 5px;
			font-size: 15px;
			font-family: 'Roboto Slab', serif;
			width: 31vw;
			min-height: 3vh;
			max-height: 25vh;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#updateUserForm").submit(function() {
				event.preventDefault();
				var currentname = $("#currentname").val();
				var name = $("#name").val();
				var email = $("#email").val();
				var age = $("#age").val();
				var password = $("#password").val();

				if (name!="" && email!="" && age!="" && password!="") {
					$.ajax({
						url: "includes/updateuser.php",
						type: "POST",
						data: {
							currentname: currentname,
							name: name,
							email: email,
							age: age,
							password: password},
						cache: false,
						success: function(data) {
							var data = JSON.parse(data);
							if (data.statusCode == 200) {
								alert("User's data was edited!");
								location.replace("adminpage.php");
							} else if (data.statusCode == 201) {
								alert("Error occured!");
							} else if (data.statusCode == 202) {
								alert("User with these data is already exists!");
							}
						}
					});
				} else {
					alert("Please fill all the field!");
				}
			});
		});
	</script>
</head>
<body>
<?php include_once "header.php";
require_once 'includes/DBconnection/link.php';
mysqli_query($link, "SET NAMES 'UTF8'");
$sel = mysqli_query($link,"SELECT * FROM users WHERE id='".$_GET['id']."'");
$user = mysqli_fetch_array($sel);
?>
<div id="signup">
	<form id="updateUserForm">
		<fieldset>
			<legend>To edit user</legend>
				<input style="display: none;" type="text" id="currentname" value="<?=$user['name'];?>">
				<div id="line"><div id="label"><label>Name:</label></div><input type="text" id="name" value="<?=$user['name'];?>"></div>
				<div id="line"><div id="label"><label>Email:</label></div><input type="email" id="email" value="<?=$user['email']?>"></div>
				<div id="line"><div id="label"><label>Age:</label></div><input type="number" id="age" value="<?=$user['age']?>"></div>
				<div id="line"><div id="label"><label>Password:</label></div><input type="text" id="password" value="<?=$user['password']?>"></div>
				<div id="line"><input type="submit" value="Update"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php"?>
</body>
</html>