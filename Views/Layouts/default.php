<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="<?= $baseUrl ?>/static/css/main.css" />
    <script src="<?= $baseUrl ?>/static/js/main.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<?php require_once('page\html\header.php') ?>
<div class="container <?= $containerClass ?>">
    <div class="content">
        <?php echo $content_for_layout ?>
    </div>

    <?php require_once ('page\html\footer.php')?>

</div>

</body>
</html>