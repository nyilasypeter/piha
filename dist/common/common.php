<?php
include 'constants.php';
function redirectTo($url)
{
    if (!headers_sent()) {
        header('Location: ' . $url);
        exit;
    } else {
        throw new Exception('Cannot redirect, headers already sent');
    }
}

function checkLoggedIn(){
    session_start();
    if(!isset($_SESSION["login"]) ){
        redirectTo(CONTEXT_ROOT . "/login.php");
    }
}
function getMyTheme(){
    session_start();
    if(isset($_SESSION["css"]) ){
        return file_get_contents($_SESSION["css"]);
    }
    return file_get_contents("https://www.w3schools.com/lib/w3-theme-indigo.css");

}
