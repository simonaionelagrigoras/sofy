<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="static/css/main.css" />
    <script src="static/js/main.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('settings.php');?>
</head>
<body>
<?php require_once (getDir('page\html\header.php'))?>

<div class="container contact">
    <div class="content">
        <h3> Contact </h3>
        <div class="col-sm-6">
            <h3>Programare Web, Facultatea de Informatica Iasi, UAIC</h3>
            <a href="http://www.uaic.ro/studii/facultati-2/facultatea-de-informatica/">
                <h3>Contact Facultatea de Informatica Iasi</h3>
            </a>
            <br>
            <h4>Motas David</h4>
            <img src="https://i.imgur.com/Kn823Pr.jpg">
            <br>
            <p><em>Email: motasdavid9@gmail.com</em></p>
            <p><em>Phone: 0757670379</em></p>
            <h4>Grigoras Simona</h4>
            <img src="https://i.imgur.com/JJXgBKy.jpg">
            <br>
            <p><em>Email: simona.ionela.grigoras@gmail.com</em></p>
            <br>
            <h4>Grigoras Marian</h4>
            <br>
        </div>
        <div class="col-sm-6">
            <h3>Map</h3>
            <div class="mapouter">
                <div class="gmap_canvas">
                    <iframe width="600" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=facultatea%20informatica%20iasi&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                    <a href="https://www.crocothemes.net"></a>
                </div>
                <style>.mapouter{position:relative;text-align:right;height:500px;width:600px;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:600px;}</style>
            </div>

            <button type="button" onclick="document.getElementById('demo').innerHTML = Date()">Click me to display Date and Time.</button>
            <p id="demo"></p>
        </div>

    </div>

    <?php require_once (getDir('page\html\footer.php'))?>

</div>

</body>
</html>