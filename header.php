<?php
error_reporting(0);
session_start();
?>
<link rel="stylesheet" type="text/css" href="css/header_style.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
<header>
	<div id="top-nav">
		<a href="index.php"><img src="header/logotype.png" width="120"></a>
		<div id="search">
			<form action="search.php" method="post">
				<span><input type="text" name="search" placeholder="Search" required="required"></span><input type="submit" value="Search" name="button">
			</form>
		</div>
		<ul class="nonli">
			<?php
			if (!isset($_SESSION['user'])) {?>
				<li><a class='nonactive' href="signupform.php">Sign up</a></li>
				<li><a class='nonactive' href="signinform.php">Sign in</a></li>
			<?php }
			else {?>
				<li><a class='active' href=<?php if($_SESSION['user']['type']=='user'): echo "userpage.php"; else: echo "adminpage.php"; endif;?>><?=$_SESSION['user']['name'];?></a></li>
				<li><a class='active' href='logout.php'>Log out</a></li>
			<?php }?>
		</ul>
	</div>
	<div id="bottom-nav">
		<ul class="nonli">
			<li><a class='menu' href="index.php">HOME</a></li>
		</ul>
	</div>
</header>