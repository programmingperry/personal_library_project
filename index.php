<?php 
require_once "./inc/head.php";
require_once "./inc/nav.php";
require_once "./Classes_Functions/DB.php";

$conn = dbConnect(); 

?>

<body class="dark-academia">
  <div class="container mt-4">
    <div id="content">
    </div>
  </div>
</body>

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
          })
          .catch(err => {
            document.getElementById('content').innerHTML = `<p class="text-danger">Fehler: ${err.message}</p>`;
          });
      }
    });
  });
});
</script>