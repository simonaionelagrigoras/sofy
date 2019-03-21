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
        <h3> About us </h3>
        <h4>The project was developed by a team of 3 members:</h4>
       <h5><em>Grigoras Simona</em></h5>
       <h5><em>Grigoras Marian</em></h5>
       <h5><em>Motas David</em></h5>
    </div>
</body>
</html>
