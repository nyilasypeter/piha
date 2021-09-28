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

function isLoggedIn(){
    session_start();
    return isset($_SESSION["login"]);
}

function hideIfNotLoggedIn(){
    if(!isLoggedIn()) return ("style=display:none");
}

function hideIfLoggedIn(){
    if(isLoggedIn()) return ("style=display:none");
}
function getMyTheme(){
    session_start();
    if(isset($_SESSION["css"]) ){
        return file_get_contents($_SESSION["css"]);
    }
    return file_get_contents("https://www.w3schools.com/lib/w3-theme-indigo.css");
}
function notBlank($str){
    return isset($str) && trim($str) != "";
}
