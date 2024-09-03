<?php
$conn = new mysqli("localhost", "root", "", "projekty");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$idProjektu = $_POST['idProjektu'];
$nick = $_POST['nick'];
$ocena = $_POST['ocena'];
$tresc = $_POST['tresc'];

$sql = "INSERT INTO recenzje (idProjektu, nick, ocena, tresc) 
        VALUES ($idProjektu, '$nick', $ocena, '$tresc')";

if ($conn->query($sql) === TRUE) {
    echo "Recenzja została dodana";
} else {
    echo "Błąd: " . $conn->error;
}

$conn->close();
?>

<a href="details.php?id=<?php echo $idProjektu; ?>">Powrót do szczegółów projektu</a>
