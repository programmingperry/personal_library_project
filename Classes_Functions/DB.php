<?php 

function dbConnect() {
    $servername = "localhost";
    $username = "root";
    $password = "";

    try {
    $pdo = new PDO("mysql:host=$servername;dbname=booknook", $username, $password);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
    } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    return null;
    }

}

// Show books
function getBooks($pdo) {
    $sql = "SELECT book.bookTitle, author.authorName FROM book LEFT JOIN books_authors ON book.bID = books_authors.bID LEFT JOIN author ON books_authors.aID = author.aID"; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
}

// Add book
function normalizeInput(array $data, array $fields): array {
        foreach ($fields as $field) {
            if (isset($data[$field]) && $data[$field] === '') {
                $data[$field] = null;
            }
        }
        return $data;
    }

function loadSelection($pdo, $table, $column) {
    $allowedTables = ['genre', 'tag', 'format', 'language'];
    $allowedColumns = ['genreTitle', 'tagTitle', 'formatName', 'languageName'];

    if (in_array($table, $allowedTables) && in_array($column, $allowedColumns)) {
        header ('Content-type: application/json');

        if ($table === 'language') {
            // Sprache braucht lID und languageName
            $sql = "SELECT lID, languageName FROM language ORDER BY languageName ASC";
        } else {
            $sql = "SELECT $column FROM $table ORDER BY $column ASC";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($result);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid table- or column-name']);
    }
}


function getOrCreateId($pdo, $table, $column, $value) {
    $idColumns = [
        'author' => 'aID',
        'genre' => 'gID',
        'format' => 'fID',
        'tag' => 'tID',
        'language' => 'lID',
    ];

    if (!isset($idColumns[$table])) {
        throw new Exception("Kein ID-Spaltenname für Tabelle '$table' definiert.");
    }

    $idColumn = $idColumns[$table];

    $stmt = $pdo->prepare("SELECT $idColumn FROM $table WHERE $column = :value");
    $stmt->execute([':value' => $value]);
    $id = $stmt->fetchColumn();

    if ($id) {
        return $id;
    }

    $stmt = $pdo->prepare("INSERT INTO $table ($column) VALUES (:value)");
    $stmt->execute([':value' => $value]);

    return $pdo->lastInsertId();
}

function validateRequiredFields($data, $requiredFields) {
    $errors = [];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            $errors[] = "Das Feld '$field' ist erforderlich.";
        }
    }
    return $errors;
}
