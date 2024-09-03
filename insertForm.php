<?php
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <title>Dodaj nowy projekt</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">
    <h1>Dodaj nowy projekt</h1>
    <form action="insert.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nazwa">Nazwa:</label>
            <input type="text" id="nazwa" name="nazwa" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="zdjecie">Zdjęcie:</label>
            <input type="file" id="zdjecie" name="zdjecie" class="form-control">
        </div>
        
        <div class="form-group">
            <label for="idKategorii">Kategoria:</label>
            <select id="idKategorii" name="idKategorii" class="form-control">
                <?php
                $sql = "SELECT id, nazwa FROM kategorie ORDER BY nazwa";
                $result = $conn->query($sql);
                while ($row = $result->fetch_object()) {
                    echo "<option value='$row->id'>$row->nazwa</option>";
                }
                $conn->close();
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="opis">Opis:</label>
            <textarea id="opis" name="opis" class="form-control"></textarea>
        </div>
        
        <div class="form-group">
            <label for="TypBudynku">Typ budynku:</label>
            <input type="text" id="TypBudynku" name="TypBudynku" class="form-control">
        </div>

        <div class="form-group">
            <label for="StylArchitektoniczny">Styl Architektoniczny:</label>
            <input type="text" id="StylArchitektoniczny" name="StylArchitektoniczny" class="form-control">
        </div>
        
        <div class="form-group">
            <input type="submit" value="Dodaj projekt" class="btn btn-submit">
        </div>
    </form>

    <a href="index.php" class="btn btn-back">Powrót do strony głównej</a>
</div>

</body>
</html>
