console.log('addbook.js loaded');
function initAddBookForm() {
  if (window.__formInitialized) return;
  window.__formInitialized = true;

  console.log('initAddBookForm called');
  const form = document.querySelector('#addBookForm');
  if (!form) {
    console.log('Form not found!');
    return;
  }
  console.log('Form found, adding listener');

  form.addEventListener('submit', async (e) => {
    const messageContainer = document.querySelector('#messageContainer');

    console.log('Form submit intercepted');
    e.preventDefault();
    messageContainer.textContent = ''; 

    const formData = new FormData(form);

    try {
      const response = await fetch('./Classes_Functions/processAddbook.php', {
        method: 'POST',
        body: formData
      });

      const data = await response.json();

      if (data.success) {
        messageContainer.textContent = data.message;
        messageContainer.style.color = 'green';
        form.reset();
      } else {
        messageContainer.textContent = Array.isArray(data.errors) ? data.errors.join(', ') : data.message;
        messageContainer.style.color = 'red';
      }
    } catch (err) {
      messageContainer.textContent = 'Server-Fehler: ' + err.message;
      messageContainer.style.color = 'red';
    }
  });
}

async function loadChoices() {
  try {
    // Genres
    let response = await fetch('../Classes_Functions/loadselection.php?table=genre&column=genreTitle');
    let data = await response.json();
    new Choices('#genres', {
      removeItemButton: true,
      placeholderValue: 'Select or add genres',
      addItems: true,
      choices: data.map(item => ({ value: item.genreTitle, label: item.genreTitle }))
    });

    // Formate
    response = await fetch('../Classes_Functions/loadselection.php?table=format&column=formatName');
    data = await response.json();
    new Choices('#format', {
      removeItemButton: true,
      placeholderValue: 'Select or add format',
      addItems: true,
      choices: data.map(item => ({ value: item.formatName, label: item.formatName }))
    });

    // Tags
    response = await fetch('../Classes_Functions/loadselection.php?table=tag&column=tagTitle');
    data = await response.json();
    new Choices('#tags', {
      removeItemButton: true,
      placeholderValue: 'Select or add tags',
      addItems: true,
      choices: data.map(item => ({ value: item.tagTitle, label: item.tagTitle }))
    });

    // Language
    response = await fetch('../Classes_Functions/loadselection.php?table=language&column=languageName');
    data = await response.json();
    const languageChoices = data.length ? data : [{ lID: '', languageName: 'No languages found' }];
    new Choices('#language', {
      placeholderValue: 'Select or add language',
      searchEnabled: true,
      shouldSort: true,
      addItems: true,
      removeItemButton: false,
      duplicateItemsAllowed: false,
      choices: languageChoices.map(item => ({ value: item.lID, label: item.languageName }))
    });
  } catch (err) {
    console.error('Selection could not be loaded:', err);
  }
}
