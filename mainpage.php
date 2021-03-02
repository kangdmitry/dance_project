<!DOCTYPE html>
<html>
<head>
	<title>Main Page</title>
	<meta charset="utf-8">
	<style type="text/css">
		#main {
			height: 64vh;
			width: 100%;
		}
		#main #background {
			position: absolute;
			background-size: cover;
			display: flex;
			justify-content: center;
			z-index: -1;
			height: 64vh;
			width: 100%;
		}
		#main #competitions {
			height: 64vh;
			width: 80vw;
			margin-left: 10vw;
			text-align: center;
			color: white;
			background-color: rgba(0.5,0.5,0.5,0.8);
		}
		#main #competitions name {
			font-size: 30px;
		}
		#main #competitions status {
			font-size: 18px;
		}
		#main #competitions description {
			font-size: 15px;
			margin: 0px 10px;
		}
		.participate {
			color: white;
			background-color: #7dccff;
			font-size: 20px;
			border: 3px solid #7dccff;
			border-radius: 5px;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#participateBtn").click(function() {
				event.preventDefault();
                var competition_id = $("#competition_id").val();
                var user_name = $("#user_name").val();
                var phone = $("#phone").val();
                var category = $('#category').val();
                if (category != null && phone!="") {
                	$.ajax({
	                	url: "includes/participate.php",
	                	type: "POST",
	                	data: {
	                		competition_id: competition_id,
	                		user_name: user_name,
	                		phone: phone,
	                		category: category
	                	},
	                	cache: false,
	                	success: function (data) {
	                		var data = JSON.parse(data);
	                		if (data.statusCode == 200) {
	                			alert("You have been added to the competition!");
	                			location.reload();
	                		} else if (data.statusCode == 201) {
	                			alert("Error occured!");
	                		} else if (data.statusCode == 202) {
	                			alert("Sorry, one user can particpate only once!");
	                			location.reload();
	                		}
	                	}
	                });
                } else {
                	alert("Please fill all fields!");
                }
			});
		});
	</script>
</head>
<body>
	<?php include_once "header.php"?>
	<?php require_once "includes/DBconnection/link.php";
	mysqli_query($link, "SET NAMES 'UTF8'");
    $result = mysqli_query($link,"SELECT * FROM competitions WHERE id='".$_GET['id']."'");
    $row  = mysqli_fetch_array($result);
    if(is_array($row)) :?>
    	<div id='main'>
    		<div id='background' style='background-image: url(https://i.pinimg.com/originals/a3/8a/4b/a38a4b95456ef210c65bfba8a5a126c3.jpg);'>
    		</div>
    		<div id='competitions'><br>
				<name><?=$row['name']?></name><br><br>
				Status: <status><?=$row['status']?></status><br><br>
				<description><?=$row['description']?></description><br>
				<?php if(isset($_SESSION['user']['name'])) :?>
					<form id="participateForm">
						<div>
							<input style='display: none;' id='competition_id' value='<?=$row['id'];?>'>
							<input style='display: none;' id='user_name' value='<?=$_SESSION['user']['name'];?>'>
							<p>Phone number: <input type='text' value='' id='phone' required="required">
							<select id="category"  required="required" style="color: black; padding: 5px; border-width: 0px; border-radius: 5px; margin-left: 20px; font-family: sans-serif; font-size: 20px;">
								<option value="Ballet">Ballet</option>
								<option value="National">National</option>
								<option value="Hip-hop">Hip-hop</option>
							</select></p>
						</div>
						<input class='participate' type='submit' id="participateBtn" value='Participate'>
					</form>
					<br>
					<?php require_once "includes/DBconnection/link.php";
					mysqli_query($link, "SET NAMES 'UTF8'");
				    $result = mysqli_query($link,"SELECT * FROM participants WHERE user_name='".$_SESSION['user']['name']."' 
				    	AND competition_id='".$row["id"]."'");
				    $num = mysqli_num_rows($result);
    				if($num>0) {?>
    				<a href='chat.php?id=<?=$row["id"];?>' style='text-decoration: none;'>
						<input class='participate' type='button' value='Chat'>
					</a>
				<?php } endif; ?>
			</div>
		</div>
		<?php endif; ?>
	<?php include_once "footer.php";?>
</body>
</html>