<?php
require("db.php");
require("menu.php");
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Projekty</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="container">

<span style="text-align: center">
<div class="container">

    <div style="text-align: center">
    <hr><h1>Lista kategorii</h1><hr><br>
        <?php
        $sql = "SELECT id, nazwa FROM kategorie";
        $result = $conn->query($sql);
        echo "<a href='index.php' class='kategoria-link wszystkie'>Wszystkie</a> ";
        while ($row = $result->fetch_object()) {
            echo "<a href='index.php?idKat=$row->id' class='kategoria-link'>$row->nazwa</a> ";
        }
        ?>
    </div>

</div>

</span>

<h2>Wyszukaj projekt:</h2>
<form>
    <input type="text" name="fraza">
    <input type="submit" value="Wyszukaj">
</form>
<hr>
<a href="insertForm.php" class="button">Dodaj nowy projekt</a>

<h2>Lista projektów:</h2>
<?php
$sql = "SELECT id, nazwa, zdjecie FROM projekty";

if (isset($_GET["idKat"])) {
    $idKat = $_GET["idKat"];
    $sql .= " WHERE idKategorii = $idKat";
} elseif (isset($_GET["fraza"])) {
    $fraza = $_GET["fraza"];
    $sql .= " WHERE nazwa LIKE '%$fraza%'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table class='favorites-table'><tr><th>Zdjęcie</th><th>Nazwa</th></tr>";
    while ($row = $result->fetch_object()) {
        echo "<tr style='text-align: center'><td><img alt='Zdjecie projektu' src='zdjecia/$row->zdjecie' width='100'></td>
              <td><a href='details.php?id=$row->id'>$row->nazwa</a></td></tr>";
    }
    echo "</table>";
} else {
    echo "Brak projektów do wyświetlenia";
}
$conn->close();
?>
</div>

<script>
    $(document).ready(function() {
        console.log('jQuery załadowane, wersja: ' + $.fn.jquery);
    });
</script>

</body>
</html>
