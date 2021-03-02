<?php
session_start();
require_once "DBconnection/link.php";
$password = $_POST["password"];
$newpassword = $_POST["newpassword"];
$sel = $link->query("SELECT * FROM users WHERE name = '".$_SESSION['user']['name']."' and password = '".$password."'");
if ($sel->num_rows == 1) {
    $stmt = $link->prepare("UPDATE users SET password = ? WHERE name = '".$_SESSION['user']['name']."'");
    $stmt->bind_param("s", $newpassword);
    if($stmt->execute()) {
        echo json_encode(array('statusCode'=>200));
    } else {
        echo json_encode(array('statusCode'=>201));
    }
    $stmt->close();
} else {
    echo json_encode(array('statusCode'=>202));
}
?>