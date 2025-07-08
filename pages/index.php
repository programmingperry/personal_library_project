<?php 
  $pagetitle = 'Welcome to the Book Nook Library';
  $page = 'welcome';
  require_once "../inc/head.php";
?>

<body class="dark-academia">
  
  <div class="container mt-4">
    <div id="content">
      </div>
    </div>

<!-- <script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();

        const text = e.target.textContent.trim().toLowerCase();
        let url = null;

        if (text === 'add') url = './inc/addbook.php';
        else if (text === 'books') url = './inc/bookoverview.php';

        if (url) {
          fetch(url)
            .then(res => res.text())
            .then(html => {
              document.getElementById('content').innerHTML = html;

              if (!document.querySelector('script[src="./JS/addbook.js"]')) {
                const script = document.createElement('script');
                script.src = './JS/addbook.js';
                script.onload = () => {
                  if (typeof initAddBookForm === 'function') initAddBookForm();
                  if (typeof loadChoices === 'function') loadChoices();
                };
                document.body.appendChild(script);
              } else {
                // Script schon da – Funktionen manuell aufrufen
                if (typeof initAddBookForm === 'function') initAddBookForm();
                if (typeof loadChoices === 'function') loadChoices();
              }
          });
        }
      });
    });
  });
</script>

</body> -->