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

<script src="./JS/formHandlers.js"></script>

<script>
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

              initFormHandlers();

              const script = document.createElement('script');
              script.src = './JS/addbook.js';
              script.onload = () => {
                if (typeof initAddBookForm === 'function') initAddBookForm();
                if (typeof loadChoices === 'function') loadChoices();
              };
              document.body.appendChild(script);
            });
        }
      });
    });
  });
</script>

</body>