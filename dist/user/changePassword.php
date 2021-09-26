<?php
include_once '../common/common.php';
session_start();
$pwdChange = null;
if (
    isset($_POST["username"])
    && isset($_POST["old_pwd"])
    && isset($_POST["new_pwd"])
    && isset($_POST["new_pwd2"])
) {
    if (
        $_POST["new_pwd"] == $_POST["new_pwd2"]
        && changePassword($_POST["username"], $_POST["old_pwd"], $_POST["new_pwd"])
    ) {
        $pwdChange = "OK";
    } else {
        $pwdChange = "NOT_OK";
    }
}

function changePassword($name, $oldPassword, $newPassword)
{
    $db = include '../common/db.php';
    $query = "SELECT * FROM appuser where name = :name and password = :pwd";
    $statement = $db->prepare($query);
    $statement->execute(['name' => $name, 'pwd' => $oldPassword]);
    if ($statement->rowCount() > 0) {
        $pwdChangeXml = createXml($name, $newPassword);
        changePasswordFromXml($pwdChangeXml);
        return true;
    }
    return false;
}

function createXml($name, $newPassword)
{
    $xmlString = <<<EOD
            <?xml version="1.0" encoding="UTF-8"?>
            <PasswordChange>
                <pwd>PWD_TO_REPLACE</pwd>
                <userName>USERNAME_TO_REPLACE</userName> 
            </PasswordChange>
            EOD;
    $xmlString = str_replace("PWD_TO_REPLACE", $newPassword, $xmlString);
    $xmlString = str_replace("USERNAME_TO_REPLACE", $name, $xmlString);
    return $xmlString;
}

function changePasswordFromXml($xml)
{
    $doc = new DOMDocument();
    $doc->loadXML($xml);
    $userName = $doc->getElementsByTagName("userName")->item(0)->nodeValue;
    $pwd = $doc->getElementsByTagName("pwd")->item(0)->nodeValue;
    error_log('nypk username:' . $userName);
    error_log('nypk pwd:' . $pwd);

    $db = include '../common/db.php';
    $statement = $db->prepare("UPDATE appuser SET password = :pwd where name = :name");
    //$pdo->beginTransaction();
    $statement->execute(["name" => $userName, "pwd" => $pwd]);
    //$statement->execute(["pwd" => $pwd]);
    //$pdo->commit();
}
?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    <?=getMyTheme()?>
</style>

<body>
    <?php checkLoggedIn(); ?>

    <div class="w3-container ">
        <?php include '../menu.php'; ?>
        <div class="w3-half w3-display-middle">
            <h2>Change your password</h2>
            <?php
            global $pwdChangeSuccesfull;
            if ($pwdChange == "OK") {
                echo '<div class="w3-panel w3-green"><p>Password change succesfull</p></div>';
            } else if ($pwdChange == "NOT_OK") {
                echo '<div class="w3-panel w3-red"><p>Password change did not succeed</p></div>';
            }
            ?>
            <form action="changePassword.php" method="POST" class="">

                <div class="w3-row-padding">
                    <div>
                        <label class="w3-text-theme"><b>Name</b></label>
                        <input class="w3-input w3-border" name="username" value="<?= $_SESSION["login"]; ?>" type="text" readonly>
                    </div>
                    <div>
                        <label class="w3-text-theme"><b>Old password</b></label>
                        <input class="w3-input w3-border" name="old_pwd" type="password">
                    </div>
                    <div>
                        <label class="w3-text-theme"><b>New password</b></label>
                        <input class="w3-input w3-border" name="new_pwd" type="password">
                    </div>
                    <div>
                        <label class="w3-text-theme"><b>New password again</b></label>
                        <input class="w3-input w3-border" name="new_pwd2" type="password">
                    </div>
                </div>

                <p>
                    <button class="w3-btn w3-theme">Change</button>
                </p>

            </form>
        </div>

    </div>

</body>

</html>