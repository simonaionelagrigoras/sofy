<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="static/css/main.css" />
    <script src="static/js/main.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once('settings.php');?>
</head>
<body>
    <?php require_once (getDir('page\html\header.php'))?>

    <div class="container">
        <div class="content">

        </div>
        <?php require_once (getDir('page\html\footer.php'))?>
    </div>
</body>
</html>