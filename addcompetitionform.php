<!DOCTYPE html>
<html>
<head>
	<title>Adding a new manga</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#signup {
			height: 59.5vh;
			margin-top: 20px;
		}
		#addCompetitionForm {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
		}
		#addCompetitionForm fieldset {
			padding: 20px;
			border-color: #7dccff;
		}
		#addCompetitionForm fieldset legend {
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
			$("#addCompetitionForm").submit(function() {
				event.preventDefault();
				var name = $("#name").val();
				var status = $("#status").val();
				var description = $("#description").val();

				$.ajax({
					url: "includes/addcompetition.php",
					type: "POST",
					data: {
						name: name,
						status: status,
						description: description},
					cache: false,
					success: function(data) {
						var data = JSON.parse(data);
						if (data.statusCode == 200) {
							alert("New competition was added!");
							location.reload();
						} else if (data.statusCode == 201) {
							alert("Error occured!")
						} else if (data.statusCode == 202) {
							alert("This competition already exists in database!");
						}
					}
				});
			});
		});
	</script>
</head>
<body>
<?php
include_once "header.php";
require_once "includes/DBconnection/link.php";
mysqli_query($link, "SET NAMES 'UTF8'");
?>
<div id="signup">
	<form id="addCompetitionForm">
		<fieldset>
			<legend>Adding a new competition</legend>
				<div id="line"><div id="label"><label>Name:</label></div><input type="text" id="name" placeholder="name" required="required"></div>
				<div id="line"><div id="label"><label>Status:</label></div><input type="text" id="status" placeholder="status" required="required"></div>
				<div id="line"><div id="label"><label>Description:</label></div><textarea id="description" placeholder="description" required="required"></textarea></div>
				<div id="line"><input type="submit" value="Add"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php"?>
</body>
</html>