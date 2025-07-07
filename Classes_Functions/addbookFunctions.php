<?php 

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
    $idColumnMap = [
      'author' => 'aID',
      'format' => 'fID',
      'language' => 'lID',
      'genre' => 'gID',
      'tag' => 'tID',
    ];
    $idColumn = $idColumnMap[$table] ?? 'id';

    $stmt = $pdo->prepare("SELECT $idColumn FROM $table WHERE $column = :value");
    if (!$stmt) {
        $errorInfo = $pdo->errorInfo();
        die("Fehler bei SELECT prepare in getOrCreateId: " . implode(", ", $errorInfo));
    }
    if (!$stmt->execute([':value' => $value])) {
        $errorInfo = $stmt->errorInfo();
        die("Fehler bei SELECT execute in getOrCreateId: " . implode(", ", $errorInfo));
    }
    $id = $stmt->fetchColumn();

    if ($id) {
        return $id;
    } else {
        $stmt = $pdo->prepare("INSERT INTO $table ($column) VALUES (:value)");
        if (!$stmt) {
            $errorInfo = $pdo->errorInfo();
            die("Fehler bei INSERT prepare in getOrCreateId: " . implode(", ", $errorInfo));
        }
        if (!$stmt->execute([':value' => $value])) {
            $errorInfo = $stmt->errorInfo();
            die("Fehler bei INSERT execute in getOrCreateId: " . implode(", ", $errorInfo));
        }
        return $pdo->lastInsertId();
    }
}


