<?php
require "DBconnection/link.php";
$name = $_POST["name"];
$email = $_POST["email"];
$age = $_POST["age"];
$password = $_POST["password"];
$repassword = $_POST["repassword"];

$sel = mysqli_query($link,"SELECT * FROM users WHERE name = '".$name."'");
$res = mysqli_fetch_array($sel);

if (!is_array($res) && $password==$repassword) {
	$stmt = $link->prepare("INSERT INTO users (name, email, age, password) VALUES (?,?,?,?)");
	$stmt->bind_param("ssis", $name, $email, $age, $password);
	if ($stmt->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
		echo json_encode(array('statusCode'=>202));
	}
	$stmt->close();
} else {
	echo json_encode(array('statusCode'=>201));
}
?>