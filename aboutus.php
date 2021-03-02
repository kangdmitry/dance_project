<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#aboutus {
			height: 63.5vh;
		}
		#div {
			display: flex;
			justify-content: space-around;
			font-size: 20px;
		}
		#aboutus h1 {
			font-size: 35px;
			margin: 1vh 0;
			margin-left: 6vw;
			display: flex;
		}
		#aboutus p {
			font-size: 20px;
			margin-left: 5vw;
			display: flex;
		}
	</style>
</head>
<body>
<?php include_once "header.php"?>
<div id="aboutus">
	<h1>Dance competitions</h1>
	<p>Description of site</p>
	<hr>
	<div id="div">
		<div>
			<dd>
				<dl>Administrator/Creator</dl>
				<dt>
					<ul>
						<li>Name: Liya</li>
						<li>Surname: Kim</li>
						<li>University: NIS Taraz</li>
						<li>Course: Computer Science</li>
					</ul>
				</dt>
			</dd>
		</div>
		<div>
			<img src="footer/profile.png" width="200">
		</div>
	</div>
</div>
<?php include_once "footer.php"?>
</body>
</html>