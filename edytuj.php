<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=lista_zadan', 'root', '');

$login = $_GET['login'] ?? null;
$id = $_GET['id'] ?? null;
$tytul = $_POST['tytul'] ?? null;
$deadline = $_POST['deadline'] ?? null;
$status = $_POST['status'] ?? null;

if(isset($_SESSION['czyZalogowany']) && $_SESSION['czyZalogowany']) {
    $czyZalogowany = true;
}
else {
    header('Location: index.php');
}

$stmt = $db->query("select * from zadania");
$zadania = $stmt->fetchAll();

if($tytul !== null && $deadline !== null && $status !== null){
    $stmt = $db->query("update zadania set tytul='$tytul', deadline='$deadline', status='$status' where id=$id");
    header("Location: lista_zadan.php?login=$login");
}

if($id !== null && $id !== ''){
    $stmt = $db->query("select * from zadania where id=$id");
    $zadania = $stmt->fetch();
}
else{
    header("Location: lista_zadan.php?login=$login");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista zadań - edycja zadania</title>
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
                <h2>Edytuj zadanie</h2>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="tytul">Tytuł</span>
                        <input type="text" class="form-control" aria-label="Sizing example input" name="tytul" aria-describedby="tytul" value="<?= $zadania['tytul'] ?>">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="deadline">Deadline</span>
                        <input type="date" class="form-control" aria-label="Sizing example input" name="deadline" aria-describedby="deadline" value="<?= $zadania['deadline'] ?>">
                    </div>
                    <label for="status" class="text-white">Status: </label>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="btn-check" name="status" id="do_zrobienia" value="do zrobienia" autocomplete="off" <?php if($zadania['status'] == 'do zrobienia'){echo 'checked';}?>>
                        <label class="btn btn-outline-success" for="do_zrobienia">do zrobienia</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="btn-check" name="status" id="w_trakcie" value="w trakcie" autocomplete="off" <?php if($zadania['status'] == 'w trakcie'){echo 'checked';}?>>
                        <label class="btn btn-outline-warning" for="w_trakcie">w trakcie</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="btn-check" name="status" id="zakonczone" value="zakończone" autocomplete="off" <?php if($zadania['status'] == 'zakończone'){echo 'checked';}?>>
                        <label class="btn btn-outline-danger" for="zakonczone">zakończone</label>
                    </div>
                    <br>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="submit" class="btn btn-primary">Edytuj</button>
                        <button type="button" class="btn btn-secondary"><a href="lista_zadan.php?login=<?= $login ?>" class="link-light">Anuluj</a></button>
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