<?php
require_once "../Classes_Functions/DB.php";
$pdo = dbConnect();
header("Content-Type: application/json; charset=UTF-8");
$jsonData = currentlyReading($pdo);
echo $jsonData;