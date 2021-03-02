<?php
require_once "DBconnection/link.php";
$user_name = $_POST["user_name"];
$competition_id = $_POST["competition_id"];
$phone = $_POST["phone"];
$category = $_POST["category"];

$sel = mysqli_query($link,"SELECT * FROM participants WHERE user_name = '".$user_name."' and competition_id = '".$competition_id."'"); 
if(mysqli_num_rows($sel) == 0) {
	$ins = $link->prepare("INSERT INTO participants (category, phone, user_name, competition_id) VALUES ('".$category."','".$phone."','".$user_name."','".$competition_id."')");
	if ($ins->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
		echo json_encode(array('statusCode'=>201));
	}
} else {
    echo json_encode(array('statusCode'=>202));
}
?>