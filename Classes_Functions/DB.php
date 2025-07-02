<?php 

function dbConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
    $PDO = new PDO("mysql:host=$servername;dbname=booknook", $username, $password);
    // set the PDO error mode to exception
    $PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $PDO;
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return null;
    }

}

function loadSelection($PDO, $table, $column) {
    $allowedTables = ['genre', 'tag', 'format'];
    $allowedColumns = ['genreTitle', 'tagTitle', 'formatName'];

    if (in_array($table, $allowedTables) && in_array($column, $allowedColumns)) {
        header ('Content-type: application/json');
        $sql = "SELECT $column FROM $table ORDER BY $column ASC";
        $stmt = $PDO->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid table- or column-name']);
    }
}

