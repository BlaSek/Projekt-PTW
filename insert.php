<?php
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$nazwa = $_POST['nazwa'];
$idKategorii = $_POST['idKategorii'];
$opis = $_POST['opis'];
$TypBudynku = $_POST['TypBudynku'];
$StylArchitektoniczny = $_POST['StylArchitektoniczny'];
$zdjecie = $_FILES['zdjecie']['name'];
$target_dir = "zdjecia/";
$target_file = $target_dir . basename($zdjecie);

move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $target_file);

$sql = "INSERT INTO projekty (idKategorii, nazwa, zdjecie, opis, TypBudynku, StylArchitektoniczny) 
        VALUES ($idKategorii, '$nazwa', '$zdjecie', '$opis', '$TypBudynku', '$StylArchitektoniczny')";

if ($conn->query($sql) === TRUE) {
    echo "Nowy projekt został dodany";
} else {
    echo "Błąd: " . $conn->error;
}

$conn->close();
?>

<a href="index.php">Powrót do strony głównej</a>
