<?php require_once "includes/DBconnection/link.php";
	mysqli_query($link, "SET NAMES 'UTF8'");
	$check = mysqli_query($link, "SELECT status FROM competitions WHERE id='".$_GET['id']."'");
	$status = mysqli_fetch_array($check);
	if ($status['status']==="ended") {
		header("Location: adminpage.php");
	} else {?>
<!DOCTYPE html>
<html>
<head>
	<title>Shop</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		body::-webkit-scrollbar {
			width: 1em;
		}
		body::-webkit-scrollbar-track {
  			box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
		}
		body::-webkit-scrollbar-thumb {
  			background-color: darkgrey;
  			outline: 1px solid slategrey;
		}
		#shop {
			background-color: rgba(0,0,0,0.05);
			max-width: 100vw;
		}
		table {
			width: 98vw;
			height: 62.2vh;
			overflow-y: auto;
			border: 0px;
			border-radius: 10px;
			background-color: white;
		}
		tr {
			padding: 0px;
			display: grid;
			grid-template-columns: 1fr 1fr 1fr 1fr;
			border-bottom: 1px solid grey;
		}
		td {
			margin: 20px;
			display: flex;
			justify-content: center;
			align-items: center;
		}
		td form {
			width: 100%;
		}
		td img {
			transition: all 0.2s ease-out;
		}
		td img:hover {
			transform: scale(1.2);
		}
		td form input {
			border: 0px;
			border-radius: 5px;
			background-color:  #7dccff;
			font-family: 'Roboto Slab', serif;
			font-size: 18px;
			padding: 5px;
			width: 100%;
			color: white;
		}
		td form input:hover {
			cursor: pointer;
			background-color: #059bfc;
		}
		#form {
			display: none;
		}
		button {
			width: 100%;
			font-family: 'Roboto Slab', serif;
			font-size: 15px;
			font-weight: 600;
			border: 0px;
			background-color: white;
		}
	</style>
	<script src="https://code.jquery.com/jquery-3.5.1.js" crossorigin="anonymous"></script>
	<script>
		$(document).ready(function() {
			$("#end").submit(function() {
				event.preventDefault();
				var id = $("#id").val();
				var status = "ended";

				if (status!="") {
					$.ajax({
						url: "includes/endcompetition.php",
						type: "POST",
						data: {
							id: id,
							status: status},
						cache: false,
						success: function(data) {
							var data = JSON.parse(data);
							if (data.statusCode == 200) {
								alert("Competition was ended!");
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


			var reverse = [false, false, false];
			$("button").click(function() {
				var table, rows, switching, i, x, y, shouldSwitch, index = $(this).attr("id");
	  			table = document.getElementById("table");
	  			switching = true;
	  			while (switching) {
	    			switching = false;
	    			rows = table.rows;
	    			for (i = 1; i < (rows.length - 1); i++) {
	    				shouldSwitch = false;
	    				x = rows[i].getElementsByTagName("TD")[index];
	      				y = rows[i + 1].getElementsByTagName("TD")[index];
	      				if (!reverse[index]) {
	      					if (parseInt(x.innerHTML, 10) > parseInt(y.innerHTML, 10)) {
		      					shouldSwitch = true;
		      					break;
		      				}
	      				} else {
	      					if (parseInt(x.innerHTML, 10) < parseInt(y.innerHTML, 10)) {
		      					shouldSwitch = true;
		      					break;
		      				}
	      				}
	      				
	    			}
	    			if (shouldSwitch) {
	    				rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
	    				switching = true;
	    			}
	  			}
	  			if (reverse[index]) {reverse[index] = false;}
	  			else {reverse[index] = true;}
			});
		});
	</script>
</head>
<body>
	<?php include_once "header.php"?>
	<div id="shop">
	<?php
	$result = mysqli_query($link,"SELECT * FROM participants WHERE competition_id='".$_GET['id']."'");
	echo "<table id='table'>";
	echo "<tr><th>User name</th><th><button id='1'>Mark</button></th><th>Category</th><th>Action</th>";
	while($participant = mysqli_fetch_array($result)) {
	echo "<tr>
	<td><h2>{$participant['user_name']}</h2></td>
	<td>{$participant['mark']}</td>
	<td>{$participant['category']}</td>
	<td><form action='markform.php' method='post'>
		<input type='text' style='display: none;' name='id' value='{$participant['competition_id']}'>
		<input type='text' style='display: none;' name='user_name' value='{$participant['user_name']}'>
		<input type='submit' value='Mark'>
		</form>
	</td>
	</tr>";
	}
	echo "</table>";?>
	<center><form id="end">
		<input type="text" style="display: none;" id="id" value="<?=$_GET['id']?>">
		<input type="submit" value="END the competition" style="border: 0px; background-color: #7bf02d; cursor: pointer; padding: 10px; font-size: 15px;">
	</form></center>
	</div>
	<?php include_once "footer.php"?>
</body>
</html>
<?php } ?>