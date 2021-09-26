<?php
include_once '../common/common.php';
checkLoggedIn();
if (isset($_GET["username"])) {
    move_uploaded_file($_FILES["profilepicture"]["tmp_name"], $target_file);
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
       

        <form method="GET" action="userprofiles.php"  class="w3-margin-top">

            <h2 class="w3-text-theme">Check other user's profile pictures!</h2>

            <p>
                <label class="w3-text-theme"><b>Name of user</b></label>
                <input class="w3-input w3-border" name="username" type="text">
            </p>
            <p>
                <input type="submit" name="submit" class="w3-btn w3-theme" value="Search">
            </p>

        </form>

        <div class="w3-card-4 w3-margin-top" style="width:25%">
            <img src="profilePicture.php?username=<?= $_GET['username'] ?>" alt="Search for a user's picture..." style="width:100%">
            <div class="w3-container w3-center">
                <p>Profile picture</p>
            </div>
        </div>

    </div>

</body>

</html>