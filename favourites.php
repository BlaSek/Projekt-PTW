<?php
require("db.php");
require("menu.php");

$idUzytkownika = $_SESSION["id"];
$sql = "SELECT d.id, d.nazwa, d.zdjecie FROM projekty d, ulubione u WHERE u.idProjektu = d.id AND idUzytkownika = $idUzytkownika";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulubione</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<div class="container">
    <table class="favorites-table">
        <thead>
            <tr>
                <th>Nazwa projektu</th>
                <th>Zdjęcie</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['nazwa'] ?></td>
                    <td><img src="zdjecia/<?= $row['zdjecie'] ?>" alt="<?= $row['nazwa'] ?>" class="thumbnail"></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

</body>
</html>
