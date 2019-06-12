<!DOCTYPE html>
<html lang="en">
<head>
    <title>Sofy</title>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jstree/3.3.8/themes/default/style.min.css" />
    <link rel="stylesheet" href="<?= $baseUrl ?>/static/css/main.css" />
    <link rel="stylesheet" href="<?= $baseUrl ?>/static/css/upload.css" />
    <script src="<?= $baseUrl ?>/static/js/main.js"></script>
    <!-- Used for responsive design in order to control dimensions and scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= $baseUrl ?>/static/media/images/favicon.png" />
    <meta name="theme-color" content="#000">



</head>
<body>
<?php require_once('page\html\header.php') ?>
<?php if(isset($_SESSION['success_message']) && strlen(trim($_SESSION['success_message']))):?>
    <div class="response-message success"><?= trim($_SESSION['success_message'])?></div>
    <?php unset($_SESSION['success_message'])?>
<?php endif?>
<?php if(isset($_SESSION['error_message']) && strlen(trim($_SESSION['error_message']))):?>
    <div class="response-message error"><?= trim($_SESSION['error_message']) ?></div>
    <?php unset($_SESSION['error_message'])?>
<?php endif?>


<div class="container <?= $containerClass ?>">
    <div class="content">
        <?php echo $content_for_layout ?>
    </div>

    <?php require_once ('page\html\footer.php')?>

</div>

</body>
</html>