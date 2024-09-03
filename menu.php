<?php
require("session.php");
require("db.php");
?>
<nav>
    Witaj <?= $_SESSION["login"] ?>!
    <a href="index.php">Strona główna</a>
    <a href="favourites.php">Ulubione</a>
    <a href="myReviews.php">Moje recenzje</a>
    <?php if (isset($_SESSION['rola']) && $_SESSION['rola'] == 'admin') {
    echo '<a href="adminReports.php">Prośba o kontakt</a>';
    }
    ?>
    <a href="logout.php">Wyloguj</a>
</nav>