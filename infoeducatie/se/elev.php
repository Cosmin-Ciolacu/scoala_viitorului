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
        <script src="js/elev.js"></script>
        <title>BINE AI VENIT PROF.<?php echo $_SESSION["username"]; ?></title>
        <style>
            body{
                background: #f1f1f1;
            }
            a {
                text-decoration:none;
                color: #343a40;
            }
            #header{
                background: url(img/header.png);
                background-size: cover;
            }
            </style>
    </head>
    <body>
    <div id="bar" style="position:fixed;z-index: 10;">
        <span style="font-size:30px;cursor:pointer;color:#c99e10;/*float:left*/left:0;" onclick="deschidere()">&#9776; Meniu</span>
        <div id="item2"><div style="background-image:url('img/notificare_icon.svg'); width: 100%;height:100%;background-size:100% 100%;"></div></div>
        <div id="item"><i class="material-icons">search</i></div>
    </div>
    <div id="mySidenav" class="meniu">
        <div class="nume"><?php echo $_SESSION["username"]; ?></div>
        <center>
            <img src="img/<?php echo get_image($con, $_SESSION['username']); ?>" class="imagine" />
        </center>
        <a href="javascript:void(0)" class="closebtn" onclick="inchidere()">&times;</a>
        <a href="elev.php">LECTII NOI</a>
        <a href="exercitiinoi.php">APLICATII NOI</a>
        <a href="teste.php">TESTE</a>
        <a href="deconectare.php">DECONECTARE</a>
    </div>
    <div id="header">
        <div class="text">PAGINA DE PORNIRE</div>
    </div>
        <br><br><br>
        <div id="lectii"></div>
        <div id="searchbox">
           <input type="text" id="cautare" name="cautare" placeholder="Cauta elevi sau lectii" >
           <div id="rezultat"></div>
        </div>
        </body>
        </html>
