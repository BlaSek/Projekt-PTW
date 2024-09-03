<?php
require("session.php");
require("db.php");

if (isset($_POST["tresc"])) {
    $user = $_POST["user"];
    $idProjektu = $_POST["idProjektu"];
    $ocena = $_POST["ocena"];
    $tresc = $_POST["tresc"];

    $sql = "INSERT INTO recenzje (idProjektu, nick, ocena, tresc) VALUES ('$idProjektu', '$user', '$ocena', '$tresc')";
    $conn->query($sql);

    header("Location: details.php?id=$idProjektu");
    exit();
}
?>
