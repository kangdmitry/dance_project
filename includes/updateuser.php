<?php
require_once "DBconnection/link.php";
$select = mysqli_query($link,"SELECT * FROM users WHERE name = '".$_POST['name']."'");
$num = mysqli_num_rows($select);

if ($num == 0 || $_POST['name'] == $_POST['currentname']) {
	$update = "UPDATE users SET name=?, email=?, age=?, password=? WHERE name='".$_POST['currentname']."'";
	$upd = $link->prepare($update);
	$upd->bind_param("ssis", $_POST['name'], $_POST['email'], $_POST['age'], $_POST['password']);
	if ($upd->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
		echo json_encode(array('statusCode'=>201));
	}
} else {
	echo json_encode(array('statusCode'=>202));
}