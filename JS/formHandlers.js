function initFormHandlers() {
  const input = document.querySelector('#myInput');
  if (input) {
    input.focus();
    input.addEventListener('blur', () => {
      if (input.value.trim() === '') {
        input.classList.add('is-invalid');
      } else {
        input.classList.remove('is-invalid');
      }
    });
  }
}
