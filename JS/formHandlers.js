/* redundant -> happens in addbook.js
function initFormHandlers() {
  console.log('[formHandlers] init');

  const form = document.querySelector('#addBookForm');
  if (!form) {
    console.warn('Formular nicht gefunden!');
    return;
  }

  form.addEventListener('submit', function (e) {
    e.preventDefault();
    console.log('[formHandlers] Submit abgefangen');

    const formData = new FormData(form);

    fetch('../inc/processAddbook.php', {
      method: 'POST',
      body: formData,
    })
      .then(res => res.json())
      .then(data => {
        console.log('[formHandlers] Erfolgreich gespeichert:', data);
      })
      .catch(err => {
        console.error('[formHandlers] Fehler:', err);
      });
  });
}
