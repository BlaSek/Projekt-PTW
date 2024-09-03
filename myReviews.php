<?php
require("menu.php");
require("db.php");

$login = $_SESSION["login"];
$sql = "SELECT recenzje.*, projekty.nazwa 
        FROM recenzje 
        JOIN projekty ON recenzje.idProjektu = projekty.id 
        WHERE recenzje.nick='$login'";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Moje recenzje</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
<div class="container">

    <h1>Moje recenzje</h1><hr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <p><strong>Projekt:</strong> <a href="details.php?id=<?= $row["idProjektu"] ?>"><?= $row["nazwa"] ?></a><br>
            <strong>Ocena:</strong> <?= $row["ocena"] ?> / 5<br>
            <strong>Treść:</strong> <?= $row["tresc"] ?><br>
            <strong>Data:</strong> <?= $row["data"] ?></p>
    <?php endwhile; ?>
</div>
</body>
</html>
