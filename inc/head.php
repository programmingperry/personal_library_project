<?php 
    require_once "../Classes_Functions/DB.php";
    require_once "../Classes_Functions/helpers.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Library Book Tracking Program">
    <meta name="keywords" content="Books, Reading, Media Library">
    <meta name="author" content="Nele McCurrach">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php if (!empty($pagetitle)) {
        echo $pagetitle;
        } else {
            echo 'The Book Nook';
        } ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Averia+Gruesa+Libre&family=Overlock:ital,wght@0,400;0,700;0,900;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link href="../CSS/custom.css" rel="stylesheet">
</head>

<header>
    <div>
    <img class="bookshelf" src="../assets/bookshelf2.png">
  </div>
    <?php if (!isset($page)) $page = ''; ?>
    <nav id="navigation" class="navbar navbar-expand-lg dark-academia">
    <div class="container-fluid">
        <a class="navbar-brand" href="../pages/index.php" <?php if ($page === 'welcome'): ?> class="active"<?php endif; ?>>The Book Nook</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
            <a class="nav-link" href="#" role="button">Books</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="../pages/addbook.php" role="button" <?php if ($page === 'addbook'): ?> class="active"<?php endif; ?>>Add</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" role="button">TBR</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="#" role="button">Stats</a>
            </li>
        </ul>
        </div>
    </div>
    </nav>

</header>

<main>
    
    <?php if (!empty ($pagetitle)): ?>
        <h2 id="pageTitle" class="mb-4 text-center dark-academia"><?php echo $pagetitle; ?></h2>
    <?php endif; ?>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
</html>