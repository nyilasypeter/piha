<?php

include 'common/common.php';

session_start();

if (isset($_POST["username"]) && isset($_POST["password"])) {
    if (passwordValid($_POST["username"], $_POST["password"])) {
        $_SESSION["login"] = $_POST["username"];
        redirectTo("welcome.php");
    }
}

function passwordValid($usrname, $pwd)
{
    $db = include 'common/db.php';
    $query = "SELECT * FROM appuser where name = :name and password = :pwd";
    $statement = $db->prepare($query);
    $statement->execute(['name' => $usrname, 'pwd' => $pwd]);
    if ($statement->rowCount() > 0) {
        return TRUE;
    }
    return FALSE;
}

?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">


<body>


    <form action="login.php" method="POST" class="w3-container w3-half w3-display-middle w3-card-4">

        <h2 class="w3-text-blue">Please login first!</h2>

        <p>
            <label class="w3-text-blue"><b>Username</b></label>
            <input class="w3-input w3-border" name="username" type="text">
        </p>
        <p>
            <label class="w3-text-blue"><b>Password</b></label>
            <input class="w3-input w3-border" name="password" type="password">
        </p>
        <p>
            <button class="w3-btn w3-blue">Login</button>
        </p>

        <a href="register.php">Register</a>

    </form>

   

</body>

</html>