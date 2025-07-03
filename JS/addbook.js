function initAddBookForm() {

    // Genres
  fetch('./Classes_Functions/loadselection.php?table=genre&column=genreTitle')
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
  fetch('./Classes_Functions/loadselection.php?table=format&column=formatName')
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
  fetch('./Classes_Functions/loadselection.php?table=tag&column=tagTitle')
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
  fetch('./Classes_Functions/loadselection.php?table=language&column=languageName')
  .then(response => response.json())
  .then(data => {
    const languageChoices = data.length ? data : [{ lID: '', languageName: 'No languages found' }];
    new Choices('#language', {
      placeholderValue: 'Select or add language',
      searchEnabled: true,
      shouldSort: true,
      addItems: true,
      removeItemButton: false,
      duplicateItemsAllowed: false,
      choices: languageChoices.map(item => ({
        value: item.lID,
        label: item.languageName
      }))
    });
  })
  .catch(err => console.error('Error loading languages:', err));


}