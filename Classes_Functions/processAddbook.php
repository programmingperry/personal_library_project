<?php
session_start();

require_once 'DB.php'; 
require_once 'addbookFunctions.php';
require_once 'helpers.php';

$pdo = dbConnect();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validateBookInput($_POST);

    if (!empty($errors)) {
        jsonResponse(false, 'Fehler im Formular', ['errors' => $errors]);
    }
    
    echo "<pre>POST Daten erhalten:\n";
    var_dump($_POST);
    echo "</pre>";
    
    $nullableFields = ['publishingYear', 'nonFiction', 'dateStarted', 'dateFinished', 'pages', 'hours', 'minutes', 'image', 'rating', 'review', 'dnf', 'owned', 'lID'];
    $_POST = normalizeInput($_POST, $nullableFields);
    
    // Get POST-Values
    $bookTitle = $_POST['bookTitle'] ?? '';
    $authorName = $_POST['author'] ?? '';
    if (empty($bookTitle)) {
        $_SESSION['error'] = "Bitte einen Titel eingeben.";
        header("Location: ../inc/addbook.php");
        exit; }
        elseif (empty($authorName)) {
        $_SESSION['error'] = "Bitte einen Autoren eingeben.";
        header("Location: ../inc/addbook.php");
        exit; 
        }
    $authorID = getOrCreateId($pdo, 'author', 'authorName', $authorName);
  $publishingYear = $_POST['publishingYear'] ?? null;
  $dateStarted = $_POST['dateStarted'] ?? null;
  if ($dateStarted === '') {
      $dateStarted = null;
  }
  $dateFinished = $_POST['dateFinished'] ?? null;
  if ($dateFinished === '') {
    $dateFinished = null;
  }
  $pages = $_POST['pages'] ?? null;
  $hours = $_POST['hours'] ?? 0;
  $minutes = $_POST['minutes'] ?? 0;
  $nonFiction = $_POST['nonFiction'] ?? 'Fiction';
  $formatName = $_POST['format'] ?? '';
  $fID = getOrCreateId($pdo, 'format', 'formatName', $formatName);
  $image = $_POST['image'] ?? '';
  $rating = $_POST['rating'] ?? null;
  $review = $_POST['review'] ?? '';
  $owned = isset($_POST['owned']) ? 1 : 0;
  $dnf = isset($_POST['dnf']) ? 1 : 0;
  $lID_or_name = $_POST['lID'] ?? null;
  if ($lID_or_name === null || $lID_or_name === '') {
    $lID = null;
} elseif (is_numeric($lID_or_name)) {
    $lID = (int)$lID_or_name; 
} else {
    $lID = getOrCreateId($pdo, 'language', 'languageName', $lID_or_name);
}


  var_dump($authorID, $fID, $lID);
  var_dump($lID_or_name, $lID);

  // 2. Add new book into book table
  $sql = "INSERT INTO book 
    (bookTitle, publishingYear, dateStarted, dateFinished, pages, hours, minutes, nonFiction, image, rating, review, owned, dnf, fID, lID)
    VALUES 
    (:bookTitle, :publishingYear, :dateStarted, :dateFinished, :pages, :hours, :minutes, :nonFiction, :image, :rating, :review, :owned, :dnf, :fID, :lID)";
  
  $stmt = $pdo->prepare($sql);
  if (!$stmt) {
      $errorInfo = $pdo->errorInfo();
      die("Fehler beim vorbereiten des Statements: " . implode(", ", $errorInfo));
  }

  if (!$stmt->execute([
  ':bookTitle' => $bookTitle,
  ':publishingYear' => $publishingYear,
  ':dateStarted' => $dateStarted,
  ':dateFinished' => $dateFinished,
  ':pages' => $pages,
  ':hours' => $hours,
  ':minutes' => $minutes,
  ':nonFiction' => $nonFiction,
  ':image' => $image,
  ':rating' => $rating,
  ':review' => $review,
  ':owned' => $owned,
  ':dnf' => $dnf,
  ':fID' => $fID,
  ':lID' => $lID
  ])) {
    $errorInfo = $stmt->errorInfo();
    die("Fehler beim Einfügen in die Datenbank: " . implode(", ", $errorInfo));
  }

  // Get Book ID
  $bookID = $pdo->lastInsertId();

  // Connect author to book
  $stmt = $pdo->prepare("INSERT INTO books_authors (bID, aID) VALUES (:bookID, :authorID)");
  $stmt->execute([':bookID' => $bookID, ':authorID' => $authorID]);

  // Connect genres to book
  $genres = $_POST['genres'] ?? [];
  foreach ($genres as $genreTitle) {
    $genreID = getOrCreateId($pdo, 'genre', 'genreTitle', $genreTitle);
    $stmt = $pdo->prepare("INSERT INTO books_genres (bID, gID) VALUES (:bookID, :genreID)");
    $stmt->execute([':bookID' => $bookID, ':genreID' => $genreID]);
  }

  // Connect tags to book
  $tags = $_POST['tags'] ?? [];
  foreach ($tags as $tagTitle) {
    $tagID = getOrCreateId($pdo, 'tag', 'tagTitle', $tagTitle);
    $stmt = $pdo->prepare("INSERT INTO books_tags (bID, tID) VALUES (:bookID, :tagID)");
    $stmt->execute([':bookID' => $bookID, ':tagID' => $tagID]);
  }

  header('Content-Type: application/json');

echo json_encode([
    'success' => true,
    'message' => 'Book was added successfully'
]);
exit;

header('Content-Type: application/json');
http_response_code(400);
echo json_encode([
    'success' => false,
    'message' => 'Something went wrong, probably missing title, author or format.'
]);
exit;

}

$stmt = $pdo->query("SELECT lID, languageName FROM language ORDER BY languageName ASC");
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);

