
<?php
/* AJAX-Endpoint */
require_once 'DB.php'; 

$table = $_GET['table'] ?? null;
$column = $_GET['column'] ?? null;

if ($table && $column) {
    $PDO = dbConnect();                   
    loadSelection($PDO, $table, $column); 
} else {
    http_response_code(400);
    echo json_encode(['error' => 'Missing parameters']);
}
