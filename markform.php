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
				var user_name = $("#user_name").val();
				var mark = $("#mark").val();
				var id = $("#id").val();

				if (mark!="") {
					$.ajax({
						url: "includes/markcompetition.php",
						type: "POST",
						data: {
							user_name: user_name,
							mark: mark,
							id: id},
						cache: false,
						success: function(data) {
							var data = JSON.parse(data);
							if (data.statusCode == 200) {
								alert("Participant's data was edited!");
								location.replace("adminpage.php");
							} else if (data.statusCode == 201) {
								alert("Error occured!");
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
$sel = mysqli_query($link,"SELECT * FROM participants WHERE competition_id='".$_POST['id']."' AND user_name='".$_POST['user_name']."'");
$participant = mysqli_fetch_array($sel);
?>
<div id="signup">
	<form id="updateUserForm">
		<fieldset>
			<legend>To assess participant</legend>
				<div id="line"><div id="label"><label>User name:</label></div><input type="text" id="user_name" value="<?=$participant['user_name'];?>" disabled="disabled"></div>
				<input type="text" style="display: none;" id="id" value="<?=$participant['competition_id'];?>" disabled="disabled">
				<div id="line"><div id="label"><label>Mark:</label></div><input type="number" id="mark" value="<?=$participant['mark']?>"></div>
				<div id="line"><input type="submit" value="To assess"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php"?>
</body>
</html>