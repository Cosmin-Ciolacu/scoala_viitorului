<?php
include ('connect.php');
$sql = "SELECT intrebare,raspuns FROM intrebari ORDER BY RAND() LIMIT 1";
$rez = mysqli_query($con, $sql);
$intrebare = '';
$raspuns = '';
while($row = mysqli_fetch_array($rez)) {
    $intrebare = $row[0];
    $raspuns = $row[1];
}
$output = array(
    'intrebare' => $intrebare,
    'raspuns' => $raspuns
);
echo json_encode($output);