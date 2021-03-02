<style type="text/css">
	body {
	margin: 0;
	font-family: 'Roboto Slab', serif;
	}
	#content {
		height: 62.2vh;
		overflow-y: auto; 
	}
	.competitions {
		padding: 20px;
		margin: 50px;
		background-size: cover;
		border-radius: 10px;
	}
	.competitions:hover {
		cursor: pointer;
	}
	.competiotins a {
		text-decoration: none;
	}
	.competitions center p {
		color: black;
		background-color: rgba(0,0,0,0.1);
		text-decoration: none;
	}
</style>
<div id="content">
	<?php
	require_once "includes/DBconnection/link.php";
	$sel = "SELECT * FROM competitions";
	$res = mysqli_query($link, $sel);
	$competitions = mysqli_fetch_all($res,MYSQLI_ASSOC);
	foreach ($competitions as $row): ?>
		<a href="mainpage.php?id=<?=$row['id'];?>" style='text-decoration: none;'>
			<div class='competitions' style='border: 3px solid #7dccff;'>
				<center>
					<p><h2 style="color: black;"><?=$row['name'];?></h2></p>
					<p><?=$row['description'];?></p>
				</center>
			</div>
		</a>
	<?php endforeach;
	?>
</div>