<?php
include('php/functions.php');
include ('php/db.php');
include ('php/functii.php');
if(! session_id() ) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Skranji" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
          rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
    <script src="memiu.js"></script>
    <title>APLICATII NOI</title>
    <style>
        body{
            background: #f1f1f1;
        }
        a {
            text-decoration:none;
            color: #343a40;
        }
        #header{
            background: url(img/Aplicatii-noi.jpg);
            background-size: cover;
        }
    </style>
</head>
<body>

<div id="bar" style="position:fixed;z-index: 10;">
    <span style="font-size:30px;cursor:pointer;color:#c99e10;/*float:left*/left:0;" onclick="deschidere()">&#9776; Meniu</span>
    <div id="item2"><div style="background-image:url('img/notificare_icon.svg'); width: 100%;height:100%;background-size:100% 100%;"></div></div>
    <div id="item"><i class="material-icons">search</i></div>
    <div id="notificari"></div>
</div>

<div id="mySidenav" class="meniu">
    <div class="nume"><?php echo $_SESSION["username"]; ?></div>
    <center>
        <img src="img/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
    </center>
    <a href="javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
    <a href="adauga.html">ADAUGA CLASE SAU ELEVI</a>
    <a href="clase.php">CLASELE MELE</a>
    <a href="teste2.php">TESTE</a>
    <a href="deconectare.php">DECONECTARE</a>
</div>
<div id="header">
    <div class="text">TESTE</div>
</div>
<br><br><br>
<div id="teste"></div>
<div id="searchbox">
    <input type="text" id="cautare" name="cautare" placeholder="Cauta lectii sau exercitii" >
    <div id="rezultat"></div>
</div>
</body>
</html>
<script>
    function deschidere() {
        document.getElementById("mySidenav").style.marginLeft = "0px";
    }

    function inchidere() {
        document.getElementById("mySidenav").style.marginLeft = "-500px";
    }
    $(document).ready(function() {
        $('#cautare').keyup(function () {
            $.ajax({
                url: 'php/cautare2.php',
                method: "POST",
                data: {cautare: $('#cautare').val()},
                success: function (data) {
                    $('#rezultat').html(data);
                },
                error: function () {
                    alert("nu");
                }
            });
        });
        $('#item').click(function () {
            if ($('#searchbox').css('margin-top') == '-60px') {
                $('#searchbox').css('margin-top', '100px');
                $('#item').html('');
                $('#item').html('<i class="material-icons">close</i>');
            } else {
                $('#searchbox').css('margin-top', '-60px');
                $('#item').html('');
                $('#item').html('<i class="material-icons">search</i>');
                $('#rezultat').html('');
            }
        });

        function afis_teste() {
            $.ajax({
                url: "php/afis_teste2.php",
                success: function (data) {
                    $('#teste').html(data);
                }
            });
        }

        afis_teste();
    });


</script>