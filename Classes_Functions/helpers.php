<?php

function jsonResponse($success, $message, $extra = []) {
    header('Content-Type: application/json');
    echo json_encode(array_merge([
        'success' => $success,
        'message' => $message
    ], $extra));
    exit;
}

function validateBookInput($data) {
    $errors = [];

    if (empty(trim($data['bookTitle'] ?? ''))) {
        $errors[] = 'Add a title.';
    }

    if (empty(trim($data['author'] ?? ''))) {
        $errors[] = 'Add an author.';
    }

    if (empty(trim($data['format'] ?? ''))) {
        $errors[] = 'Add a format.';
    }

    return $errors;
}
