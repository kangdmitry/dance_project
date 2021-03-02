<?php
require_once "DBconnection/link.php";
mysqli_query($link, "SET NAMES 'UTF8'");
$res = mysqli_query($link,"SELECT * FROM competitions WHERE name='".$_POST['name']."'"); 
$num = mysqli_num_rows($res);
if($num==0) {
	$result = $link->prepare("INSERT INTO competitions (name,status,description) VALUES (?,?,?)");
	$result->bind_param("sss",$_POST['name'],$_POST['status'],$_POST['description']);
	if ($result->execute()) {
		echo json_encode(array('statusCode'=>200));
	} else {
	  	echo json_encode(array('statusCode'=>201));
	}
} else {
    echo json_encode(array('statusCode'=>202));
}
?>