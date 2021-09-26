<?php
include_once '../common/common.php';
checkLoggedIn();
session_start();
$fileNAme;
if(isset($_GET["username"])){
    $fileNAme = $_GET["username"];
}
else{
    $fileNAme = $_SESSION["login"];
}
if(file_exists(IMAGE_FOLDER . $fileNAme . ".jpg")){
    header('Content-type: image/jpeg');
    $fileNAme.=".jpg";
}
if(file_exists(IMAGE_FOLDER . $fileNAme . ".png")){
    header('Content-type: image/png');
    $fileNAme.=".png";
}
error_log("NYP File NAME:" . $fileNAme);
echo file_get_contents(IMAGE_FOLDER . $fileNAme );

?>