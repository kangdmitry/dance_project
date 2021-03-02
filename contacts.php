<!DOCTYPE html>
<html>
<head>
	<title>Contacts</title>
	<style type="text/css">
		body {
			margin: 0;
			font-family: 'Roboto Slab', serif;
		}
		#contacts {
			display: grid;
			grid-template-columns: 0.5fr 2fr 0.5fr 2fr;
			height: 64vh;
			justify-content: center;
			align-items: center;
		}
		fieldset {
			border: 2px solid #7dccff;
		}
		fieldset legend {
			font-size: 25px;
		}
		fieldset form {
			display: block;
		}
		fieldset form * {
			margin: 3px;
		}
		fieldset form input {
			padding: 3px;
			width: 33vw;
			font-family: 'Roboto Slab', serif;
		}
		fieldset form textarea {
			resize: vertical;
			padding: 3px;
			font-family: 'Roboto Slab', serif;
			width: 33vw;
			min-height: 3vh;
			max-height: 15vh;
		}
		fieldset form input[type=submit] {
			background-color: #059bfc;
			border: 2px solid #059bfc;
			width: 35vw;
		}
		fieldset form input[type=submit]:hover {
			cursor: pointer;
			color: white;
		}
		fieldset form .line {
			display: flex;
		}
		fieldset form .line div {
			display: flex;
			padding: 0px;
			margin: 0px;
			justify-content: center;
			align-items: center;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#contactBtn").click(function() {
                event.preventDefault();
                var name = $("#name").val();
                var email = $("#email").val();
                var title = $("#title").val();
                var message = $("#message").val();
                if (name!="" && email!="" && title!="" && message!="") {
                	$.ajax({
						url: 'includes/contact.php',
						type: 'POST',
						data: {
							name: name,
							email: email,
							title: title,
							message: message},
						cache: false,
						success: function(data) {
							var data = JSON.parse(data);
							if (data.statusCode == 200) {
								$("#contactform").each(function() {
									this.reset();
								});
								alert("Thank you for taking the time to improve the site!");
							} else if (data.statusCode == 201) {
								alert("Error occured!")
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
<?php include_once "header.php"?>
<div id="contacts">
	<div></div>
	<div>
	<fieldset>
		<legend>Contact us</legend>
		<div id="warn">
			<p>
				<span>Hello, dear visitor of our site!</span><br>Using the feedback form below, you can send us an email on any topic. Within 24 hours, we will familiarize ourselves and will write you an answer to it. Thank you for choosing our site!
			</p>
		</div>
		<span id="datamessage"></span>
		<form id="contactform">
			<div class="line"><div><img src="footer/user.png" width="16" height="16"></div><input type="text" id="name" placeholder="Username" required="required"></div>
			<div class="line"><div><img src="footer/mail.png" width="16" height="16"></div><input type="email" id="email" placeholder="E-mail" required="required"></div>
			<div class="line"><div><img src="footer/document.png" width="16" height="16"></div><input type="text" id="title" placeholder="Title" required="required"></div>
			<div class="line"><div><img src="footer/edit.png" width="16" height="16"></div><textarea id="message" placeholder="Message" required="required"></textarea></div>
			<div class="line"><input type="submit" id="contactBtn" value="Submit"></div>
		</form>
	</fieldset>
	</div>
	<div></div>
	<div>
	<script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A4fbb5cf5c1c05e0f7f22624808a98c89a7ff03acc208a8d6833fb5827bf2020c&amp;width=500&amp;height=400&amp;lang=en_FR&amp;scroll=true"></script></div>
</div>
<?php include_once "footer.php"?>
</body>
</html>