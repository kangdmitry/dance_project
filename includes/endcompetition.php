<?php
require_once "DBconnection/link.php";

mysqli_query($link, "SET NAMES 'UTF8'");
	$update = "UPDATE competitions SET status=? WHERE id='".$_POST['id']."'";
	$upd = $link->prepare($update);
	$upd->bind_param("s",$_POST['status']);
	if ($upd->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
		echo json_encode(array('statusCode'=>201));
	}