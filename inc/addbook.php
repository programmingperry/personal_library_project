<?php 
$pageTitle = "Add a new Book"
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

    <div class="row mb-3">
      <div class="col">
        <label for="startDate" class="form-label">Date started</label>
        <input type="date" id="startDate" name="startDate" class="form-control">
      </div>
      <div class="col">
        <label for="endDate" class="form-label">Date finished</label>
        <input type="date" id="endDate" name="endDate" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label for="pageNumber" class="form-label">Pages</label>
      <input type="number" id="pageNumber" name="pageNumber" class="form-control" placeholder="Number of pages">
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
        <input class="form-check-input" type="radio" id="fiction" name="fictionNonFiction" value="Fiction" checked>
        <label class="form-check-label" for="fiction">Fiction</label>
      </div>
      <div class="form-check">
        <input class="form-check-input" type="radio" id="nonfiction" name="fictionNonFiction" value="Non-Fiction">
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
      <label for="language" class="form-label">Language</label>
      <select id="language" name="language" class="form-select"></select>
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

<script>
  // Genres
  fetch('../Classes_Functions/loadselection.php?table=genre&column=genreTitle')
    .then(response => response.json())
    .then(data => {
      console.log('Genres:', data); 
      new Choices('#genres', {
        removeItemButton: true,
        placeholderValue: 'Select or add genres',
        addItems: true,
        choices: data.map(item => ({
          value: item.genreTitle,
          label: item.genreTitle
        }))
      });
    })
    .catch(err => console.error('Error loading genres:', err));

  // Formats
  fetch('../Classes_Functions/loadselection.php?table=format&column=formatName')
    .then(response => response.json())
    .then(data => {
      console.log('Format:', data); 
      new Choices('#format', {
        removeItemButton: true,
        placeholderValue: 'Select or add format',
        addItems: true,
        choices: data.map(item => ({
          value: item.formatName,
          label: item.formatName
        }))
      });
    })
    .catch(err => console.error('Error loading formats:', err));

  //  Tags
    fetch('../Classes_Functions/loadselection.php?table=tag&column=tagTitle')
      .then(response => response.json())
      .then(data => {
        console.log('Tags:', data); 
        new Choices('#tags', {
          removeItemButton: true,
          placeholderValue: 'Select or add tags',
          addItems: true,
          choices: data.map(item => ({
            value: item.tagTitle,
            label: item.tagTitle
          }))
        });
      })
      .catch(err => console.error('Error loading tags:', err));

  // Language
      fetch('../Classes_Functions/loadselection.php?table=book&column=language')
        .then(data => {
          console.log('Language:', data); 
          new Choices('#language', {
            removeItemButton: true,
            placeholderValue: 'Select or add language',
            addItems: true,
            choices: data.map(item => ({
              value: item.language,
              label: item.language
          }))
        });
      })
        .catch(err => console.error('Error loading languages:', err));

</script>