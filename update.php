<?php
$conn = new mysqli("localhost", "root", "", "projektydb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$nazwa = $_POST['nazwa'];
$idKategorii = $_POST['idKategorii'];
$opis = $_POST['opis'];
$TypBudynku = $_POST['TypBudynku'];
$StylArchitektoniczny = $_POST['StylArchitektoniczny'];

$sql = "SELECT zdjecie FROM projekty WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_object();
$zdjecie = $row->zdjecie;

if (!empty($_FILES['zdjecie']['name'])) {
    $zdjecie= $_FILES['zdjecie']['name'];
    $target_dir = "zdjecia/";
    $target_file = $target_dir . basename($zdjecie);
    move_uploaded_file($_FILES["zdjecie"]["tmp_name"], $target_file);
}

$sql = "UPDATE projekty 
        SET idKategorii=$idKategorii, nazwa='$nazwa', zdjecie='$zdjecie', opis='$opis', TypBudynku='$TypBudynku', StylArchitektoniczny='$StylArchitektoniczny'
        WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Projekt został zaktualizowany";
} else {
    echo "Błąd: " . $conn->error;
}

$conn->close();
?>

<a href="details.php?id=<?php echo $id; ?>">Powrót do szczegółów projektu</a>
