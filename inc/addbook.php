<?php 
require_once "../Classes_Functions/DB.php";
$pdo = dbConnect();
$pageTitle = "Add a new Book";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  

  $nullableFields = ['publishingYear', 'dateStarted', 'dateFinished', 'pages', 'hours', 'minutes', 'rating', 'lID'];
  $_POST = normalizeInput($_POST, $nullableFields);

  // Get POST-Values
  $bookTitle = $_POST['bookTitle'] ?? '';
  $authorName = $_POST['author'] ?? '';
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

  if ($lID_or_name === null || $lID_or_name === '') {
    $lID = null;
} elseif (is_numeric($lID_or_name)) {
    $lID = (int)$lID_or_name; 
} else {
    $lID = getOrCreateId($pdo, 'language', 'languageName', $lID_or_name);
}


  var_dump($authorID, $fID, $lID);

  // 2. Add new book into book table
  $sql = "INSERT INTO book 
    (bookTitle, publishingYear, dateStarted, dateFinished, pages, hours, minutes, nonFiction, image, rating, review, owned, dnf, fID, lID)
    VALUES 
    (:bookTitle, :publishingYear, :dateStarted, :dateFinished, :pages, :hours, :minutes, :nonFiction, :image, :rating, :review, :owned, :dnf, :fID, :lID)";
  
  $stmt = $pdo->prepare($sql);
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

  echo $bookTitle . " wurde erfolgreich gespeichert.";
}

$stmt = $pdo->query("SELECT lID, languageName FROM language ORDER BY languageName ASC");
$languages = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container my-5" style="max-width: 600px;">
  <h1 class="mb-4 text-center">Add a new book</h1>

  <form method="POST">

    <div class="mb-3">
      <label for="bookTitle" class="form-label">Book title</label>
      <input type="text" id="bookTitle" name="bookTitle" class="form-control" placeholder="Enter book title">
    </div>

    <div class="mb-3">
      <label for="author" class="form-label">Author</label>
      <input type="text" id="author" name="author" class="form-control" placeholder="Enter author name">
    </div>

    <div class="mb-3">
      <label for="publishingYear" class="form-label">Publishing year</label>
      <input type="number" id="publishingYear" name="publishingYear" class="form-control" placeholder="Publishing year">
    </div>

    <div class="row mb-3">
      <div class="col">
        <label for="dateStarted" class="form-label">Date started</label>
        <input type="date" id="dateStarted" name="dateStarted" class="form-control">
      </div>
      <div class="col">
        <label for="dateFinished" class="form-label">Date finished</label>
        <input type="date" id="dateFinished" name="dateFinished" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label for="pages" class="form-label">Pages</label>
      <input type="number" id="pages" name="pages" class="form-control" placeholder="Number of pages">
    </div>

    <div class="mb-3 d-flex gap-2">
      <div class="flex-fill">
        <label for="hours" class="form-label">Audiobook Length (Hours)</label>
        <input type="number" id="hours" name="hours" class="form-control" placeholder="Hours" min="0">
      </div>
      <div class="flex-fill">
        <label for="minutes" class="form-label">Minutes</label>
        <input type="number" id="minutes" name="minutes" class="form-control" placeholder="Minutes" min="1">
      </div>
    </div>

    <fieldset class="mb-3">
      <legend class="col-form-label pt-0">Literature type</legend>
      <div class="form-check">
        <input class="form-check-input" type="radio" id="fiction" name="nonFiction" value="Fiction" checked>
        <label class="form-check-label" for="fiction">Fiction</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" id="nonfiction" name="nonFiction" value="Non-Fiction">
        <label class="form-check-label" for="nonfiction">Non-Fiction</label>
      </div>
    </fieldset>

    <div class="mb-3">
      <label for="genres" class="form-label">Genres</label>
      <select id="genres" name="genres[]" multiple class="form-select"></select>
    </div>

    <div class="mb-3">
      <label for="format" class="form-label">Format</label>
      <select id="format" name="format" class="form-select"></select>
    </div>

    <div class="mb-3">
      <label for="language">Language</label>
      <select name="lID" id="language" class="form-select"></select>
    </div>

    <div class="mb-3">
      <label for="tags" class="form-label">Tags</label>
      <select id="tags" name="tags[]" multiple class="form-select"></select>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image Link</label>
      <input type="text" id="image" name="image" class="form-control" placeholder="URL to book image">
    </div>

    <div class="mb-3">
      <label for="rating" class="form-label">Rating</label>
      <select id="rating" name="rating" class="form-select">
        <option value="">Choose Rating</option>
        <option value="0.5">0.5 ★</option>
        <option value="1">1 ★</option>
        <option value="1.5">1.5 ★</option>
        <option value="2">2 ★</option>
        <option value="2.5">2.5 ★</option>
        <option value="3">3 ★</option>
        <option value="3.5">3.5 ★</option>
        <option value="4">4 ★</option>
        <option value="4.5">4.5 ★</option>
        <option value="5">5 ★</option>
      </select>
    </div>

    <div class="mb-3">
      <label for="review" class="form-label">Review</label>
      <textarea id="review" name="review" rows="5" class="form-control" placeholder="Write a review"></textarea>
    </div>

    <div class="form-check mb-2">
      <input type="checkbox" id="owned" name="owned" value="owned" class="form-check-input">
      <label for="owned" class="form-check-label">Owned</label>
    </div>

    <div class="form-check mb-3">
      <input type="checkbox" id="dnf" name="dnf" value="dnf" class="form-check-input">
      <label for="dnf" class="form-check-label">Did not finish</label>
    </div>

    <button type="submit" class="btn btn-primary w-100">Add Book</button>
  </form>
</div>

<!-- Bootstrap JS (optional, für interaktive Komponenten) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Choices.js Styles & Script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
