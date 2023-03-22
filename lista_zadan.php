<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=lista_zadan', 'root', '');

$login = $_GET['login'];

if(isset($_SESSION['czyZalogowany']) && $_SESSION['czyZalogowany']) {
    $czyZalogowany = true;
}
else {
    header('Location: index.php');
}

$stmt = $db->query("select * from zadania, uzytkownicy where zadania.uz_login = uzytkownicy.login and zadania.uz_login = '$login'");
$zadania = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zadań</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<style>
    a{
        text-decoration: none;
    }
</style>
<body>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <div class="vh-100 p-3 mb-2 bg-dark text-white position-relative">
        <div class="row justify-content-center">
            <div class="col-10">
                    <div class="row justify-content-end p-2">
                        <div class="col-2">
                            <button type="button" class="btn btn-primary"><a href="wylogowanie.php" class="link-light">Wyloguj</a></button>
                        </div>
                    </div>
                    <h1>Lista zadań</h1>
                    <div class="vw-auto p-2 border border-primary-subtle rounded-3">
                        <div class="table-responsive">
                        <table class="table">
                            <tr class="table-dark">
                                <td>Tytuł</td>
                                <td>Termin ukończenia</td>
                                <td>Status</td>
                            </tr>
                            <?php foreach($zadania as $z): 
                                if($z['status'] == 'do zrobienia'){
                                    $status = 'success';
                                }elseif($z['status'] == 'w trakcie'){
                                    $status = 'warning';
                                }else{
                                    $status = 'danger';
                                }?>
                            <tr class="table-<?= $status ?>">
                                <td><?= $z['tytul'] ?></td>
                                <td><?= $z['deadline'] ?></td>
                                <td><?= $z['status'] ?></td>
                                <td><a href="usun.php?id=<?= $z['id'] ?>&login=<?= $login ?>" class="link-danger">Usuń</a></td>
                                <td><a href="edytuj.php?id=<?= $z['id'] ?>&login=<?= $login ?>" class="link-primary">Edytuj</a></td>
                            </tr>
                            <?php endforeach;?>
                        </table>
                        </div>
                    </div>
                    <div class="p-2">
                        <button type="button" class="btn btn-primary"><a href="dodaj.php?login=<?= $login ?>" class="link-light">Dodaj zadanie</a></button>
                    </div>
                </form>
            </div>
        </div>
        <div class="vw-100 vh-auto p-3 mb-2 text-white fixed-bottom">
            <footer>
                <div class="row justify-content-end">
                    <div class="col-2">
                        <p>Created by Katarzyna Sennik</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>
</html>