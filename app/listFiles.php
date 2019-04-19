<?php
/**
 * Created by PhpStorm.
 * User: Simona
 * Date: 28/02/2019
 * Time: 21:12
 */


$response = [];
$responseCode = 200;
$start = microtime(true);
function init(){
    header("Content-Type: application/json; charset=UTF-8");
}

function checkBodyRequest(){
    # Get JSON as a string
    $postDataJson = file_get_contents('php://input');

    # Get as an object
    $postData = json_decode($postDataJson, true);

    return $postData;
}

function runAddRequest(){
    global $responseCode;
    $postData = checkBodyRequest();

    if(isset($postData['error'])){

        $responseCode = 400;
        return $postData;
    }
    $folder =  $postData['folder'];
    $files = glob($_SERVER['DOCUMENT_ROOT'] . '/tw/sofy/' . $folder . '/*');
    foreach ($files as $file){
        $response[] = ['name' => basename($file)];
    }
    return $response;
}

init();

switch ($_SERVER['REQUEST_METHOD']){
    case 'POST':
        $response = runAddRequest();
        break;
    case 'DELETE':
        $response = [];
        break;
    default:
        $response = ['error' => 'Unrecognized request type'];
}
if(isset($response['error'])){
    $responseCode = 400;
}


echo json_encode($response);
