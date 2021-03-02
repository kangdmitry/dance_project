<?php
session_start();
if (isset($_SESSION['user'])) {
    if ($_SESSION['user']['type'] == 'user') {
        header("Location: userpage.php");
        return;
    } else if ($_SESSION['user']['type'] == 'admin') {
        header("Location: adminpage.php");
        return;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Sign up</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#signupform").submit(function() {
				event.preventDefault();
				var name = $("#name").val();
				var email = $("#email").val();
				var age = $("#age").val();
				var password = $("#password").val();
				var repassword = $("#repassword").val();

				$.ajax({
					url: "includes/signup.php",
					type: "POST",
					data: {
						name: name,
						email: email,
						age: age,
						password: password,
						repassword: repassword},
					cache: false,
					success: function(data) {
						var data = JSON.parse(data);
						if (data.statusCode == 200) {
							alert("You were registered!");
							$("#signupform").each(function() {
								this.reset();
							});
						} else if (data.statusCode == 201) {
							alert("Error occured!")
						}
					}
				});
			});
		});
	</script>
</head>
<body>
<?php include_once "header.php"?>
<div id="login">
	<form id="signupform">
		<fieldset>
			<legend>Sign up form</legend>
				<div class="line"><div class="label"><label>Name:</label></div><input type="text" id="name" placeholder="username" required="required"></div>
				<div class="line"><div class="label"><label>E-mail:</label></div><input type="email" id="email" placeholder="email" required="required"></div>
				<div class="line"><div class="label"><label>Age:</label></div><input type="number" id="age" placeholder="age" required="required"></div>
				<div class="line"><div class="label"><label>Password:</label></div><input type="password" id="password" placeholder="password" required="required"></div>
				<div class="line"><div class="label"><label>Re-password:</label></div><input type="password" id="repassword" placeholder="password" required="required"></div>
				<div class="line"><input type="submit" id="signupBtn" value="Sign up"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php"?>
</body>
</html>