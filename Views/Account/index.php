<div class="col-sm-3" id="account-navigation">
    <?php require_once ('html\left_navigation.php')?>
</div>
<div class="col-sm-9">
    <div class="profile">
        <h3><?= $userName?></h3>
        <div class="profile-photo">
            <img src="<?= $baseUrl ?>/static/media/images/profile.jpg" width="100">
        </div>
        <p><strong>Repositories updates:</strong> 3</p>
        <p><strong>Content size:</strong> <?=$_SESSION['total_size']?> MB</p>
    </div>
</div>