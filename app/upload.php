<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 19/04/2019
 * Time: 18:29
 */


if(!isset($_POST['repo'])){
    echo json_encode(['error' => 'Invalid Repository']);
}
$target_dir = "repo/" . $_POST['repo'];

$finalTargetDir = $_SERVER['DOCUMENT_ROOT'] . '/tw/sofy/' . $target_dir;
if(!file_exists($finalTargetDir)){
    echo json_encode(['error' => 'Invalid Repository']);
}
$target_file = $finalTargetDir  . '/' . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(!in_array($fileType,['txt','md','zip', 'gzip', 'tgz', 'jpg'])) {
    echo json_encode(['error' => 'Invalid file format']);
}
move_uploaded_file( $_FILES['file']['tmp_name'], $target_file);
$result = ['file_uploaded' => $_POST['repo'] . '/' . pathinfo($target_file,PATHINFO_BASENAME )];
echo json_encode($result);