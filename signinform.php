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
	<title>Sign in</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#signinBtn").click(function(){
                event.preventDefault();
                var name = $("#name").val();
                var password = $("#password").val();

                $.ajax({
                	url: 'includes/signin.php',
                    type: 'POST',
                    data: {
                    	name: name,
                        password: password},
                    cache: false,
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.statusCode == 200) {
                            alert("You signed in!");
                            window.location.href = "index.php";
                        } else if (data.statusCode == 201) {
                            alert("Error occured!");
                        }
                    }
                });
            });
		});
	</script>
</head>
<body>
<?php include_once "header.php";?>
<div id="login">
	<form id="signinform">
		<fieldset>
			<legend>Sign in form</legend>
			<div class="line"><div class="label"><label>Name:</label></div><input type="text" id="name" placeholder="username" required="required"></div>
			<div class="line"><div class="label"><label>Password:</label></div><input type="password" id="password" placeholder="password" required="required"></div>
			<div class="line"><input type="submit" id="signinBtn" value="Sign in"></div>
		</fieldset>
	</form>
</div>
<?php include_once "footer.php"; ?>
</body>
</html>