<?php
require_once "DBconnection/link.php";
$type = "user";
$name = $_POST["name"];
$password = $_POST["password"];

$sel = $link->prepare("SELECT * FROM users WHERE name='".$name."' and password='".$password."'");
$sel->execute();
$result = $sel->get_result();
$row = $result->fetch_assoc();
if($row != null && $row['name'] != null) {
    session_start();
    $_SESSION['user'] = array(
        'name' => $row['name'],
        'type' => $type
    );
    echo json_encode(array('statusCode'=>200));
} else {
    $type = "admin";
    $sel = $link->prepare("SELECT * FROM administrator WHERE name='".$name."' and password='".$password."'");
    $sel->execute();
    $result = $sel->get_result();
    $row = $result->fetch_assoc();
    if ($row != null && $row['name'] != null) {
        session_start();
        $_SESSION['user'] = array(
            'name' => $row['name'],
            'type' => $type
        );
        echo json_encode(array('statusCode'=>200));
    } else {
        echo json_encode(array('statusCode'=>201));
    }
}
$sel->close();
?>