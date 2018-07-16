<?php
session_start();
include('db.php');
$id = $_SESSION["id_utilizator"];
$output = '';
$sql = "SELECT * FROM clase WHERE id_utilizator='$id'";
$rez = mysqli_query($con,$sql);
if(mysqli_num_rows($rez) == 0) {
    $output .= '<option>nu exista clase de afisat</option>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $output .= '<option>'.$row[2].'</option>';
    }
}
echo $output;
?>