<?php
include_once '../common/common.php';
checkLoggedIn();

if (isset($_POST["css"])) {
    session_start();
    $_SESSION["css"] = $_POST["css"];
}

function isSelected($url){
    session_start();
    if($_SESSION["css"] == $url){
        return "selected";
    }
    return "";

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

    <div class="w3-container">
        <?php include '../menu.php'; ?>


        <form method="POST" action="myprofile.php" class="w3-margin-top">

            <h2 class="w3-text-theme">Choose your theme</h2>

            <p>
                <label class="w3-text-theme"><b>Your theme</b></label>
                <select class="w3-select w3-border" name="css">
                    <option value="https://www.w3schools.com/lib/w3-theme-indigo.css" <?=isSelected("https://www.w3schools.com/lib/w3-theme-indigo.css")?>>Default theme</option>
                    <option value="https://www.w3schools.com/lib/w3-theme-purple.css" <?=isSelected("https://www.w3schools.com/lib/w3-theme-purple.css")?>>Purple theme</option>
                    <option value="https://www.w3schools.com/lib/w3-theme-amber.css" <?=isSelected("https://www.w3schools.com/lib/w3-theme-amber.css")?>>Golden theme</option>
                    <option value="https://www.w3schools.com/lib/w3-theme-black.css" <?=isSelected("https://www.w3schools.com/lib/w3-theme-black.css")?>>Dark theme</option>
                </select>
            </p>
            <p>
                <input type="submit" name="submit" class="w3-btn w3-theme" value="Change">
            </p>

        </form>

    </div>

</body>

</html>