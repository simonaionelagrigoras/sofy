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

<div class="container  my-account">
    <div class="content">
<!--        <div class="row">-->
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
                            <span class="visible-xs navbar-brand">Sidebar menu</span>
                        </div>
                        <div class="navbar-collapse collapse sidebar-navbar-collapse">
                            <ul class="nav navbar-nav account">
                                <li class="active"><a href="#">Profile</a></li>
                                <li><a href="#">Statistics</a></li>
                                <li><a href="#">Account details</a></li>
                                <li><a href="#">Messages <span class="badge">2</span></a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div>
            </div>
            <div class="col-sm-9">
                <h3>User name</h3>
                <div class="profile-photo">
                    <img src="media/images/profile.jpg" width="100">
                </div>
                <p><strong>Score:</strong> 63</p>
                <p><strong>Level:</strong> Begginer</p>
            </div>
<!--        </div>-->

    </div>
    <?php require_once (getDir('page\html\footer.php'))?>
</div>
</body>
</html>