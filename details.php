<?php
require("menu.php");
require("db.php");
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Szczegóły projektu</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</head>
<body>

<div class="container">
    <h1>Szczegóły projektu</h1>

<?php
$sql = "SELECT AVG(ocena) AS srednia FROM recenzje WHERE idProjektu=$id";
$result = $conn->query($sql);
$srednia = $result->fetch_object()->srednia;

$sql = "SELECT idKategorii, k.nazwa AS nazwaKat, d.nazwa, zdjecie, d.opis, TypBudynku, StylArchitektoniczny 
        FROM projekty d, kategorie k 
        WHERE d.id=$id AND idKategorii=k.id";
$result = $conn->query($sql);
$row = $result->fetch_object();

echo "<hr class ='grubszy'><h2>$row->nazwa</h2><hr class = 'grubszy'>";
echo "<img alt='zdjecie reprezentujace projekt' src='zdjecia/$row->zdjecie' width='300'><br>";
echo "<hr><b>Kategoria:</b> <a href='index.php?idKat=$row->idKategorii'>$row->nazwaKat</a><br>";
echo "<hr><b>Opis:</b> $row->opis<br>";
echo "<hr><b>Typ budynku:</b> $row->TypBudynku<br>";
echo "<hr><b>Styl architektoniczny:</b> $row->StylArchitektoniczny<br>";
echo "<hr><b>Średnia ocen:</b> $srednia<br><hr>";

$idUzytkownika = $_SESSION["id"];

$sql2 = "SELECT id FROM ulubione WHERE idProjektu = $id AND idUzytkownika = $idUzytkownika";
$added = $conn->query($sql2)->num_rows > 0;
$image = $added ? "pelne.png" : "puste.png";
echo "<b>Dodaj do ulubionych</b>  <img width='25px' height='25px' class='fav' data-projekt='$id' src='$image' alt='Favourite'> <br> <br>";
?>


<a href="updateForm.php?id=<?php echo $id; ?>" class="button">Edytuj projekt</a>

<a href="delete.php?id=<?php echo $id; ?>" class = "button" onclick="return confirm('Czy na pewno chcesz usunąć ten projekt?');">Usuń projekt</a>
<hr class ="grubszy"><h2>Dodaj recenzję</h2>
<form action="addReview.php" method="post">
    <input type="hidden" name="user" value="<?= $_SESSION["login"] ?>">
    <input type="hidden" name="idProjektu" value="<?= $id ?>">
    <p>Ocena:
        <select name="ocena">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
    </p>
    <p>Treść: <textarea name="tresc"></textarea></p>
    <p><input type="submit" value="Dodaj recenzję"></p>
</form>
<hr class ="grubszy"><h2>Lista recenzji</h2>
<?php
$sql = "SELECT nick, ocena, tresc, data FROM recenzje WHERE idProjektu=$id";
$result = $conn->query($sql);

while ($row = $result->fetch_object()) {
    echo "<p><strong>$row->nick</strong> ($row->ocena/5) - $row->tresc <em>($row->data)</em></p>";
}

$conn->close();
?>

<hr class ='grubszy'><a href="index.php">Powrót do strony głównej</a>
</div>

</body>
</html>
