<?php
require_once "DBconnection/link.php";
mysqli_query($link, "SET NAMES 'UTF8'");
$date = date("Y-m-d H:m:s");
	$result = $link->prepare("INSERT INTO chat (competition_id,user_name,message,data) VALUES (?,?,?,'".$date."')");
	$result->bind_param("sss",$_POST['id'],$_POST['user_name'],$_POST['message']);
	if ($result->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
	  	echo json_encode(array('statusCode'=>201));
	}
?>