<?php
require_once "config.php";
require_once "database.php";

$conn = new Database(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME);

$link = $conn->connect();