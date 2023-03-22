<?php
$db = new PDO('mysql:host=localhost;dbname=lista_zadan', 'root', '');

$login = $_POST['login'] ?? null;
$haslo = $_POST['haslo'] ?? null;

$stmt = $db->query("select login from uzytkownicy where login='$login'");
$nazwa = $stmt->fetchAll();

$blad = [];
if($login !== null && $haslo !== null) {
    if($nazwa !== null && $nazwa !== '') {
        $blad[] = "Taki użytkownik już istnieje lub hasło jest nieprawidłowe";
    }
    else {
        $stmt = $db->query("insert into `uzytkownicy`(`login`, `haslo`) values ('$login', '$haslo')");
        header('Location: index.php');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zadań - rejestracja</title>
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
                <h1 class="text-white">Zarejestruj się</h1>
                <form action="rejestracja.php" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="login" name="login" placeholder="text">
                        <label for="login">Login</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="haslo" name="haslo" placeholder="password" aria-describedby="hasloPomoc">
                        <label for="haslo">Hasło</label>
                        <div id="hasloPomoc" class="form-text">Twoje hasło powinno zawierać 8 znaków. Nie powinno zawierać spacji.</div>
                    </div>
                    <div class="text-danger">
                        <?php if(!empty($blad)): ?>
                        <p><?= implode("<br>", $blad); ?></p>
                        <?php endif; ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Zarejestruj</button>
                    <button type="button" class="btn btn-secondary"><a href="index.php" class="link-light">Anuluj</a></button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>