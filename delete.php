<?php
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM recenzje WHERE idProjektu=$id";
if ($conn->query($sql) === TRUE) {
    echo "Recenzje powiązane z projektem zostały usunięte.<br>";
} else {
    echo "Błąd podczas usuwania recenzji: " . $conn->error . "<br>";
}

$sql = "SELECT zdjecie FROM projekty WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$zdjecie = $row['zdjecie'];

if ($zdjecie && file_exists("zdjecia/" . $zdjecie)) {
    unlink("zdjecia/" . $zdjecie);
    echo "Plik ze zdjęciem został usunięty.<br>";
}

$sql = "DELETE FROM projekty WHERE id=$id";
if ($conn->query($sql) === TRUE) {
    echo "Projekt został pomyślnie usunięty.";
} else {
    echo "Błąd podczas usuwania projektu: " . $conn->error;
}

$conn->close();

header("Location: index.php");
exit();
?>
