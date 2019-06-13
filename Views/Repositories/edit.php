<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 13/06/2019
 * Time: 10:14
 */

//print_r($listData);
?>
<link rel="stylesheet" href="<?= $baseUrl ?>/static/css/repositories.css" />
<div class="repo-edit">
<h3>Edit Repository:</h3>
<form action="/repositories/save/id/<?=$listData['id']?>" method="post" enctype="multipart/form-data">
    <div class="fieldset">
        <?php
        $fileSource = basename($listData['resource']) . "." . $ext = pathinfo($filename, PATHINFO_EXTENSION);
        //echo $fileSource
        ?>
        <p>Current File:
            <a rel="nofollow" href="<?= $baseUrl . '/repo/' . $listData['name']. '/' . $listData['repo_version'] . '/'. $listData['resource']?>">
                <?= $fileSource?></a>
        </p>

        <div class="fileUpload btn-primary">
            <span class="upload-text">Select files to upload</span>
            <input name="resource" id="userFile" multiple="" max="1" type="file" class="upload" />
            <input type="hidden" name="repo_name" value="<?=$listData['name']?>" />
            <input type="hidden" name="repo_version" value="<?=$listData['repo_version']?>" />
            <input type="hidden" name="current_resource" value="<?=$listData['resource']?>" />
        </div>
    </div>
    <div class="fieldset required">
        <label for="email">Version</label>
        <input type="text" id="email" class="form-control" autocomplete="off" placeholder="Version" name="version" required value="<?= $listData['version']?>" />
    </div>
    <div class="fieldset">
        <label for="password">Description</label>
        <input type="text"  class="form-control" autocomplete="off" placeholder="Description" name="description"  value="<?= $listData['description']?>" />
    </div>
    <div class="fieldset">
        <label for="confirm-password">Official Site</label>
        <input type="text"  class="form-control" autocomplete="off" placeholder="Official Site" name="official_site"  value="<?= $listData['official_site']?>" />
    </div>
    <div class="fieldset">
        <label for="confirm-password">Tags</label>
        <?php
        $tags = json_decode($listData['tags']);
        $parsedTags = '';
        if($tags){
            $parsedTags = implode(',', $tags);
        }
        ?>
        <input type="text"  class="form-control" autocomplete="off" placeholder="tag1,tag2,.." name="tags"  value="<?= $parsedTags ?>"  />
    </div>
    <input type="submit" class="btn btn-md" value="Submit Changes">
</form>
</div>