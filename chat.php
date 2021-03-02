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
			padding: 10px;
			height: 59.5vh;
			display: flex;
			justify-content: center;
			overflow-y: auto;
		}
		#chat {
			border: 2px solid black;
			margin-top: 20px;
			padding: 10px;
			width: 50vw;
			overflow-y: auto;
		}
		table {
			width: 100%;
		}
		table tr td {
			padding: 5px;
			background-color: rgba(0.5,0.5,0.5,0.1);
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
			$("#sendMessage").submit(function() {
				event.preventDefault();
				var id = $("#id").val();
				var user_name = $("#user_name").val();
				var message = $("#message").val();

				$.ajax({
					url: "includes/sendmessage.php",
					type: "POST",
					data: {
						id: id,
						user_name: user_name,
						message: message},
					cache: false,
					success: function(data) {
						var data = JSON.parse(data);
						if (data.statusCode == 200) {
							alert("Message was sended!");
							location.reload();
						} else if (data.statusCode == 201) {
							alert("Error occured!")
						} else if (data.statusCode == 202) {
							alert("This message already exists in database!");
						}
					}
				});
			});
		});
	</script>
</head>
<body>
<?php include_once "header.php";
require_once 'includes/DBconnection/link.php';
mysqli_query($link, "SET NAMES 'UTF8'");
?>
<div id="signup">

	<div id="chat">
		<?php
		$sql = "SELECT * FROM chat WHERE competition_id='".$_GET['id']."' ORDER BY data DESC";
		$result = mysqli_query($link,$sql);?>
		<?php
		echo "<table>";
		while($chat = mysqli_fetch_array($result)):?>
			<tr><td><p><span style="font-size: 20px; font-weight: 600;"><?=$chat['user_name'];?></span>: <date style="font-size: 10px;"><?=$chat['data'];?></date></p><p style="margin-left: 30px;"><?=$chat['message'];?></p></td></tr>
		<?php endwhile;
		echo "</table>";
		?>
	</div>
	<div>
		<form id="sendMessage">
			<input style="display: none;" type="text" id="id" value="<?=$_GET['id'];?>">
			<input style="display: none;" type="text" id="user_name" value="<?=$_SESSION['user']['name'];?>">
			<div id="line"><div id="label"><label>Message:</label></div><textarea id="message" placeholder="message" required="required"></textarea></div>
			<div id="line"><input type="submit" value="Send"></div>
		</form>
	</div>
</div>
<?php include_once "footer.php" ?>
</body>
</html>