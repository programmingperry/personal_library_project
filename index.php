<?php 
require_once "./inc/head.php";
require_once "./inc/nav.php";
require_once "./Classes_Functions/DB.php";

$conn = dbConnect(); 
?>

<body class="dark-academia">
  <div>
    <img class="bookshelf" src="./assets/bookshelf2.png">
  </div>
  <div class="container mt-4">
    <div id="content">
    </div>
  </div>
</body>

<script src="./JS/formHandlers.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.nav-link').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        let text = e.target.textContent.trim().toLowerCase();

        let url = null;
        if (text === 'add') {
          url = './inc/addbook.php'; 
        } else if (text === 'books') {
          url = './inc/bookoverview.php'; 
        } 

        if (url) {
          fetch(url)
            .then(response => {
              if (!response.ok) throw new Error("Fehler beim Laden");
              return response.text();
            })
            .then(html => {
              document.getElementById('content').innerHTML = html;
              initFormHandlers();

              if (url.includes('addbook.php')) {
                const script = document.createElement('script');
                script.src = './JS/addbook.js'; 
                script.onload = () => {
                  initAddBookForm();
                };
                document.body.appendChild(script);
              }
            })
            .catch(err => {
              document.getElementById('content').innerHTML = `<p class="text-danger">Fehler: ${err.message}</p>`;
            });
        }
      });
    });

    initFormHandlers(); 
  });
</script>
