<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 13/06/2019
 * Time: 08:56
 */
//echo "<pre>";
//print_r($respositories);
?>
<link rel="stylesheet" href="<?= $baseUrl ?>/static/css/repositories.css" />
<div class="repositories-list-data">


<table  border="1">
    <thead>
        <tr>
            <td>OS</td>
            <td>OS Version</td>
            <td class="app-list-item">Application</td>
            <td>Size</td>
            <td>Description</td>
            <td>App Version</td>
            <td>Official Site</td>
            <td>Tags</td>
            <td>Created At</td>
            <td>Updated At</td>
            <td>Edit</td>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($respositories as $respository):?>
            <tr>
                <td><?= $respository['name']?></td>
                <td><?= $respository['version']?></td>
                <td class="app-list-item">
                    <?php
                        $fileSource = basename($respository['resource']) . "." . $ext = pathinfo($filename, PATHINFO_EXTENSION);
                        echo $fileSource
                    ?>
                </td>
                <td><?= $respository['size'] . " MB"?></td>
                <td><?= $respository['description']?></td>
                <td><?= $respository['user_repo_version']?></td>
                <td><?= $respository['official_site']?></td>
                <td>
                    <?php
                        $tags = json_decode($respository['tags']);
                        if($tags){
                            echo implode(', ', $tags);
                        }
                        //print_r(json_decode(json_encode(['test', 'test2'])));
                    ?>
                </td>
                <td><?= $respository['created_at']?></td>
                <td><?= $respository['updated_at']?></td>
                <td><a href="edit/id/<?= $respository['id']?>">Edit</a></td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>
</div>