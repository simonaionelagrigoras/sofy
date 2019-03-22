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

    <div class="container About us">
            <div class="content">
            <div class="col-sm-3" id="account-navigation">
                <div class="sidebar-nav">
                    <div class="navbar navbar-default account" role="navigation">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <span class="visible-xs navbar-brand">My Account</span>
                        </div>
                        <div class="navbar-collapse collapse sidebar-navbar-collapse">
                            <ul class="nav navbar-nav account">
                                <li class="active"><a href="#">Profile</a></li>
                                <li><a href="#">My Repositories</a></li>
                                <li><a href="#">Account settings</a></li>
                                <li><a href="#">Messages <span class="badge">2</span></a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
        <?php require_once (getDir('page\html\footer.php'))?>
        <h3> Contact </h3>
       <h3>Programare Web, Facultatea de Informatica Iasi, UAIC</h3>
    <a href="http://www.uaic.ro/studii/facultati-2/facultatea-de-informatica/">
        <h3>Contact Facultatea de Informatica Iasi</h3>
    </a>
    <br></br>
    <h4>Motas David</h4>
<img src="https://i.imgur.com/Kn823Pr.jpg" style="width: 320px; height:320">
<br></br>
<p><em>Email: motasdavid9@gmail.com</em></p>
<p><em> Phone: 0757670379</em></p>
<h4>Grigoras Simona</h4>
<img src="https://i.imgur.com/JJXgBKy.jpg" style="width: 320px; height:420px; ">
<br></br>
<p><em>Email: simona.ionela.grigoras@gmail.com</em></p>
<br></br>
<h4>Grigoras Marian</h4>
<br></br>
<h3>Map</h3>
<div id="googleMap" style="width:100%;height:400px;"></div>
<script>
function myMap() {
var mapProp= {
    center:new google.maps.LatLng(47.151726,27.587914),
    zoom:13,
};
var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBu-916DdpKAjTmJNIgngS6HL_kDIKU0aU&callback=myMap"></script>

<button type="button"
onclick="document.getElementById('demo').innerHTML = Date()">
Click me to display Date and Time.</button>

<p id="demo"></p>
    </div>
    
</body>
</html>
