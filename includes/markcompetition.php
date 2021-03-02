<?php
require_once "DBconnection/link.php";

mysqli_query($link, "SET NAMES 'UTF8'");
$update = "UPDATE participants SET mark=? WHERE competition_id=? AND user_name=?";
$upd = $link->prepare($update);
$upd->bind_param("sss",$_POST['mark'],$_POST['id'],$_POST['user_name']);
if ($upd->execute()) {
	echo json_encode(array('statusCode'=>200));
} else {
	echo json_encode(array('statusCode'=>201));
}