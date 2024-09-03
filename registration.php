<?php
require("db.php");
if (isset($_POST["login"])) {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];
    $email = $_POST["email"];

    $sql = "INSERT INTO uzytkownicy (login, haslo, email) VALUES ('$login', '" . md5($haslo) . "', '$email')";
    $result = $conn->query($sql);
    if ($result) {
        echo "<div class='form-message success'> 
              <h3>Zostałeś pomyślnie zarejestrowany.</h3><br/> 
              <p class='link'>Kliknij tutaj, aby się <a href='login.php'>zalogować</a></p> 
              </div>";
    } else {
        echo "<div class='form-message error'> 
              <h3>Nie wypełniłeś wymaganych pól.</h3><br/> 
              <p class='link'>Kliknij tutaj, aby ponowić próbę <a href='registration.php'>rejestracji</a>.</p> 
              </div>";
    }

    
} else {
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Rejestracja</title>
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>
    <body>
    <div class="test">
        <form class="form" action="" method="post">
            <h1 class="login-title">Rejestracja</h1>
            <input type="text" class="login-input" name="login" placeholder="Login" required/>
            <input type="password" class="login-input" name="haslo" placeholder="Hasło" required/>
            <input type="text" class="login-input" name="email" placeholder="Adres email" required/>
            <input type="submit" name="submit" value="Zarejestruj się" class="login-button">
            <p class="link"><a href="login.php">Zaloguj się</a></p>
        </form>
    </div>
    </body>
    </html>
    <?php
}
?>
