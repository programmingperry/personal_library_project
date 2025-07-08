<?php 
require_once "../Classes_Functions/DB.php";
$pdo = dbConnect();
$pageTitle = "Add a new Book";
?>

<?php if (isset($_GET['success'])): ?>
  <div class="success">Book was added successfully.</div>
<?php endif; ?>

<div class="container my-5" style="max-width: 600px;">
  
  <h1 class="mb-4 text-center">Add a new book</h1>
  
  <div id="messageContainer" class="mb-3"></div>
  
  <form id="addBookForm" method="POST">

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
      <select name="lID" id="language" class="form-select">
        <option value="">-- Select language --</option>
      </select>
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
