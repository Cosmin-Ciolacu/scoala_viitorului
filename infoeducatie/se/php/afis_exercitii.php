<?php
include('db.php');
$sql = "SELECT * FROM Exercitii ORDER BY id_exercitii DESC";
$rez = mysqli_query($con,$sql);
$output = '';
if(mysqli_num_rows($rez) == 0) {
    $output .= '<div id="titlu">nu exista exercitii de afisat</div>';
} else {
    while($row = mysqli_fetch_array($rez)) {
        $id = $row[0];
        $continut = $row[2];
        $fisier = $row[3];
        if(strpos($fisier,'.jpg') || strpos($fisier,'.png')) {
            $output .= '
             <div id="text">
               <div id="indent">'.$continut.'</div>
               <center><p><img src="php/fisiere/'.$fisier.'"></p></center>
                <a href="raspunsuri/'.$id.'" class="btn btn-info">Vezi raspunsurile la aceaste exercitii</a>
             </div>
            ';
        }
    }
}
echo $output;
?>