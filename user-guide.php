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
<?php require_once(getDir('page\html\header.php')) ?>

<div class="container user-guide">
    <div class="content">
        <div class="col-md-12">
            <div class="user-guide-content">
                <img src="static/media/images/user_guide_icon.png" />
                <p>Our application can be used only by registered users.</p>
                <p>After creating an account, go to <i>My account > My Repository</i> and click "Create new repository"</p>
                <p>You can either upload a content to the new repository, or let it empty and upload later</p>
                <p>The option to add tags to the repositories is now available</p>
            </div>
        </div>
        <?php require_once(getDir('page\html\footer.php')) ?>
    </div>
</body>
</html>
