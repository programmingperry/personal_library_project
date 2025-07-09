<?php
header('Content-Type: application/json');
require_once "../inc/head.php";

$method = $_SERVER['REQUEST_METHOD'];

$sql = "SELECT * FROM  book";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);