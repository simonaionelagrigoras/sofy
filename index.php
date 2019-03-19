<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="static/css/main.css" />
    <script src="static/js/main.js"></script>

</head>
<body>
<div id="header">
    <?php $userIsLoggedIn = false?>
</div>
<div id="menu">
    <nav class="navbar navbar-inverse">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-home" href="#">Logo</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="option selected"><a href="#">Home</a></li>
                    <li class="option"><a href="#about">Features</a></li>
                    <li class="option"><a href="#contact">Contact</a></li>
                    <li class="dropdown" style="float:right">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           data-aria-expanded="false"><span class="carety" id="user-account"></span></a>
                        <ul class="dropdown-menu">
                            <?php if (!$userIsLoggedIn):?>
                            <li><a href="#">Login</a></li>
                            <li><a href="#">Registration</a></li>
                            <?php else:?>
                            <li><a href="#">My account</a></li>
                            <li><a href="#">My Repositories</a></li>
                            <li><a href="#">Personal Data</a></li>
                            <?php endif?>
                        </ul>
                    </li>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</div>
<div class="container">
    <div class="content">

    </div>
    <footer class="footer">
        <div class="row">
            <div class="col-md-3 footer-brand">
                <h2>Logo</h2>
                <p>Software Online Repository</p>
                <p>© 2018  All rights reserved</p>
            </div>
            <div class="col-md-4 footer-nav">
                <ul class="list">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Terms &amp; Condition</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>
            <div class="col-md-2 footer-nav">
                <h4>Support</h4>
                <ul class="list">
                    <li><a href="#">Help</a></li>
                    <li><a href="#">User Guide</a></li>
                    <li><a href="#">Forum</a></li>
                </ul>
            </div>
            <div class="col-md-3 footer-ns">
                <h4>Newsletter</h4>
                <p>Please subscribe for news</p>
                <p>
                </p><div class="input-group">
                    <input type="text" class="form-control" placeholder="Email address">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-envelope"></span></button>
                    </span>
                </div><!-- /input-group -->
                <p></p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>