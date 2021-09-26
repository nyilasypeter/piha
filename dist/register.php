<?php
include "common/common.php";
$regStatus = null;
if (
    isset($_POST["username"])
    && isset($_POST["new_pwd"])
    && isset($_POST["new_pwd2"])
) {
    if ($_POST["new_pwd"] != $_POST["new_pwd2"]) {
        $regStatus = "NOT_OK_PWDS_DO_NOT_MATCH";
    } else {
        if (changePassword($_POST["username"],  $_POST["new_pwd"])
        ) {
            redirectTo("login.php");
        } else {
            $regStatus = "NOT_OK_USER_EXISTS";
        }
    }
}

function changePassword($name, $newPassword)
{
    $db = include 'common/db.php';
    $query = "SELECT * FROM appuser where name = :name";
    $statement = $db->prepare($query);
    $statement->execute(['name' => $name]);
    if ($statement->rowCount() > 0) {
        return false;
    } else {
        $statement = $db->prepare("insert into appuser(id, emailaddress, motto, name, password, sex, webpageurl) VALUES (:id, null, null, :name, :pwd, 'm', null)");
        $statement->execute(["id" => $name, "name" => $name, "pwd" => $newPassword]);
        return true;
    }
}




?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<body>

    <div class="w3-container ">
        <div class="w3-half w3-display-middle">
            <h2>Register</h2>
            <?php
            if ($regStatus == "NOT_OK_PWDS_DO_NOT_MATCH") {
                echo '<div class="w3-panel w3-red"><p>The two passwords do not match</p></div>';
            } else if ($regStatus == "NOT_OK_USER_EXISTS") {
                echo '<div class="w3-panel w3-red"><p>User already exists. Try a different login name!</p></div>';
            }
            ?>
            <form action="register.php" method="POST" class="">

                <div class="w3-row-padding">
                    <div>
                        <label class="w3-text-blue"><b>Name</b></label>
                        <input class="w3-input w3-border" name="username"  type="text" >
                    </div>
                    <div>
                        <label class="w3-text-blue"><b>Password</b></label>
                        <input class="w3-input w3-border" name="new_pwd" type="password">
                    </div>
                    <div>
                        <label class="w3-text-blue"><b>Password again</b></label>
                        <input class="w3-input w3-border" name="new_pwd2" type="password">
                    </div>
                </div>

                <p>
                    <button class="w3-btn w3-blue">Register</button>
                </p>

            </form>
        </div>

    </div>

</body>

</html>