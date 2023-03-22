<?php
session_start();

$login = $_POST['login'] ?? null;
$haslo = $_POST['haslo'] ?? null;

$blad = [];
if($login !== null && $haslo !== null) {
    $db = new PDO('mysql:host=localhost;dbname=lista_zadan', 'root', '');

    $stmt = $db->query("select * from uzytkownicy where login='$login' and haslo='$haslo'");
    $uzytkownik = $stmt->fetch();

    if($uzytkownik == true) {
        $_SESSION['czyZalogowany'] = true;
        header("Location: lista_zadan.php?login=$login");
    }
    else {
        $blad[] = "Błędne dane logowania";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zadań - logowanie</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    a{
        text-decoration: none;
    }
</style>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="vw- vh-100 p-3 mb-2 bg-dark position-relative">
        <div class="row justify-content-center">
            <div class="col-4">
                <h1 class="text-white">Zaloguj się</h1>
                <form action="index.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login" name="login" placeholder="text">
                        <label for="login">Login</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="haslo" name="haslo" placeholder="password">
                        <label for="haslo">Hasło</label>
                    </div>
                    <div class="text-danger">
                        <?php if(!empty($blad)): ?>
                        <p><?= implode("<br>", $blad); ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Zaloguj</button>
                    <button type="button" class="btn btn-primary"><a href="rejestracja.php" class="link-light">Zarejestruj</a></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>