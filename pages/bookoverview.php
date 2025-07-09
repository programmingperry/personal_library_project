<?php 
    $pagetitle = 'Library';
    $page = 'bookoverview';
    require_once "../inc/head.php";

    $sql="SELECT * FROM book";
    $result = mysqli_query($pdo,$sql);
?>

<script>
</script>

<body  class="dark-academia">
    <div id="bookList" class="d-flex flex-wrap justify-content-center">
    </div>
</body>