<?php
require_once "DBconnection/link.php";

mysqli_query($link, "SET NAMES 'UTF8'");
$select = mysqli_query($link,"SELECT * FROM competitions WHERE name = '".$_POST['name']."'");
$num = mysqli_num_rows($select);
if ($num == 0 || $_POST['name'] == $_POST['currentname']) {
	$update = "UPDATE competitions SET name=?, status=?, description=? WHERE id='".$_POST['id']."'";
	$upd = $link->prepare($update);
	$upd->bind_param("sss",$_POST['name'],$_POST['status'],$_POST['description']);
	if ($upd->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
		echo json_encode(array('statusCode'=>201));
	}
} else {
	echo json_encode(array('statusCode'=>202));
}