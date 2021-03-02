<!DOCTYPE html>
<html>
<head>
	<title>Update competition</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#signup {
			margin-top: 20px;
			height: 59.5vh;
		}
		#updateCompetitionForm {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
		}
		#updateCompetitionForm fieldset {
			padding: 20px;
			border-color: #7dccff;
		}
		#updateCompetitionForm fieldset legend {
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
			$("#updateCompetitionForm").submit(function() {
				event.preventDefault();
				var currentname = $("#currentname").val();
				var id = $("#id").val();
				var name = $("#name").val();
				var status = $("#status").val();
				var description = $("#description").val();

				if (name!="" && status!="" && description!="") {
					$.ajax({
						url: "includes/updatecompetition.php",
						type: "POST",
						data: {
							id: id,
							currentname: currentname,
							name: name,
							status: status,
							description: description},
						cache: false,
						success: function(data) {
							var data = JSON.parse(data);
							if (data.statusCode == 200) {
								alert("Competition's data was edited!");
								location.replace("adminpage.php");
							} else if (data.statusCode == 201) {
								alert("Error occured!");
							} else if (data.statusCode == 202) {
								alert("Change the name please, this competition is already exists!");
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
$sel = mysqli_query($link,"SELECT * FROM competitions WHERE id='".$_GET['id']."'");
$competition = mysqli_fetch_array($sel);
mysqli_query($link, "SET NAMES 'UTF8'");
?>
<div id="signup">
	<form id="updateCompetitionForm">
		<fieldset>
			<legend>To edit competition</legend>
				<input style="display: none;" type="text" id="id" value="<?=$competition['id'];?>">
				<input style="display: none;" type="text" id="currentname" value="<?=$competition['name'];?>">
				<div id="line"><div id="label"><label>Name:</label></div><input type="text" id="name" value="<?=$competition['name'];?>" required="required"></div>
				<div id="line"><div id="label"><label>Status:</label></div><input type="text" id="status" value="<?=$competition['status'];?>" required="required"></div>
				<div id="line"><div id="label"><label>Description:</label></div><input type="text" id="description" value="<?=$competition['description'];?>" required="required"></div>
				<div id="line"><input type="submit" value="Update"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php" ?>
</body>
</html>