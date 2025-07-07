
<?php
/* AJAX-Endpoint */
require_once 'DB.php';
require_once 'addbookFunctions.php'; 

$table = $_GET['table'] ?? null;
$column = $_GET['column'] ?? null;

if ($table && $column) {
    $pdo = dbConnect();                   
    loadSelection($pdo, $table, $column); 
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing parameters']);
}


