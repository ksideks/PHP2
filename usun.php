<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=lista_zadan', 'root', '');

$login = $_GET['login'];
$id = $_GET['id'] ?? null;

if(isset($_SESSION['czyZalogowany']) && $_SESSION['czyZalogowany']) {
    $czyZalogowany = true;
}
else {
    header('Location: index.php');
}

if($id !== null && $login !== null){
    $db->query("delete from zadania where id=$id");
}

header("Location: lista_zadan.php?login=$login");