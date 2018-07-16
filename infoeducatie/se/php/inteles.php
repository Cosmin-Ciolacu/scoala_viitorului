<?php
session_start();
include('db.php');
$id_utilizator = $_SESSION['id_utilizator'];
$id_clasa = $_POST['id'];
$sql = "INSERT INTO inteles(id_utilizator,id_lectie) VALUES('$id_utilizator','$id_clasa')";
$rez = mysqli_query($con,$sql);
if($rez) {
    echo 'ok';
}
?>