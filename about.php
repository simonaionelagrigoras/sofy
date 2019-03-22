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

<div class="container about-us">
    <div class="content">
        <div class="col-md-12">
            <h2 class="about-title"><strong>Sofy</strong> - an Online Software Repository</h2>
            <h4>The project was developed by a team of 3 members:</h4>
            <h5><em>Grigoras Simona</em></h5>
            <h5><em>Grigoras Marian</em></h5>
            <h5><em>Motas David</em></h5>
            <h4>More information about the application</h4>
            <p> We have developed a web application that manages a software repository.
                These can be transferred via 'upload' by authenticated users.</p>
            <p>The uploaded applications can be grouped according to various criteria
                (such as the hardware platform, the operating system, the license type, the functionalities offered
                (eg, the utility suite, the office suite, the Internet tool) etc. or based on content tags.</p>
            <p>The system will allow you to add additional information for each uploaded application, such as description, official website, version history, update frequency, etc.
                The upload date, number of downloads, size, other similar applications will be displayed.</p>
            <p>A profile where it will be able to view all the applications loaded by it.
                The system will also provide a user-level or administrator-level management interface,
                the generated reports being available in HTML, CSV and PDF formats</p>

            <a href="https://twitter.com/RepositorySofy?ref_src=twsrc%5Etfw" class="twitter-follow-button" data-show-count="false">Follow @RepositorySofy</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
    <?php require_once (getDir('page\html\footer.php'))?>
</body>
</html>
