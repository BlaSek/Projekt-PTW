<?php
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT idKategorii, nazwa, zdjecie, opis, TypBudynku, StylArchitektoniczny FROM projekty WHERE id=$id";
$result = $conn->query($sql);
$projekt = $result->fetch_object();

$sql = "SELECT id, nazwa FROM kategorie ORDER BY nazwa";
$kategorie = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Edytuj projekt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Edytuj projekt</h1>
    <form action="update.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <div class="form-group">
            <label for="nazwa">Nazwa:</label>
            <input type="text" id="nazwa" name="nazwa" class="form-control" value="<?php echo $projekt->nazwa; ?>">
        </div>

        <div class="form-group">
            <label for="zdjecie">Zdjęcie:</label>
            <input type="file" id="zdjecie" name="zdjecie" class="form-control">
        </div>

        <div class="form-group">
            <label>Aktualne zdjęcie:</label>
            <img src="zdjecia/<?php echo $projekt->zdjecie; ?>" width="100" alt="zdjęcie prezentujące projekt">
        </div>

        <div class="form-group">
            <label for="idKategorii">Kategoria:</label>
            <select id="idKategorii" name="idKategorii" class="form-control">
                <?php
                while ($row = $kategorie->fetch_object()) {
                    $selected = $projekt->idKategorii == $row->id ? "selected" : "";
                    echo "<option value='$row->id' $selected>$row->nazwa</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" class="form-control"><?php echo $projekt->opis; ?></textarea>
        </div>

        <div class="form-group">
            <label for="TypBudynku">Typ budynku:</label>
            <input type="text" id="TypBudynku" name="TypBudynku" class="form-control" value="<?php echo $projekt->TypBudynku; ?>">
        </div>

        <div class="form-group">
            <label for="StylArchitektoniczny">Styl architektoniczny:</label>
            <input type="text" id="StylArchitektoniczny" name="StylArchitektoniczny" class="form-control" value="<?php echo $projekt->StylArchitektoniczny; ?>">
        </div>

        <div class="form-group">
            <input type="submit" value="Zaktualizuj projekt" class="btn btn-submit">
        </div>
    </form>

    <a href="details.php?id=<?php echo $id; ?>" class="btn btn-back">Powrót do szczegółów projektu</a>
</div>

</body>
</html>

<?php $conn->close(); ?>
