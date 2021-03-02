<?php
require_once "DBconnection/link.php";
	
$name = $_POST["name"];
$email = $_POST["email"];
$title = $_POST["title"];
$message = $_POST["message"];

$ins = $link->prepare("INSERT INTO contact (name, email, title, message) VALUES (?, ?, ?, ?)");
$ins->bind_param("ssss", $name, $email, $title, $message);

if ($ins->execute()) {
	echo json_encode(array('statusCode' => 200));
} else {
	echo json_encode(array('statusCode' => 201));
}
$ins->close();
?>