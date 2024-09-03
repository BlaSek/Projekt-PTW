<?php
require('db.php');
session_start();

if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    $sql = "SELECT * FROM uzytkownicy WHERE login='$login' AND haslo='" . md5($haslo) . "'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_object();
        $_SESSION["login"] = $login;
        $_SESSION["id"] = $user->id;
        $_SESSION["rola"] = $user->rola;
        header("Location: index.php");
    } else {
        echo "<div class='form'> 
              <h3>Nieprawidłowy login lub hasło.</h3><br/> 
              <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='login.php'>logowania</a>.</p> 
              </div>";
    }
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Logowanie</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div class="test">
        <form class="form" action="" method="post">
            <h1 class="login-title">Logowanie</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" required/>
            <input type="password" class="login-input" name="haslo" placeholder="Hasło" required/>
            <input type="submit" name="submit" value="Zaloguj się" class="login-button">
            <p class="link"><a href="registration.php">Rejestracja</a></p>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
