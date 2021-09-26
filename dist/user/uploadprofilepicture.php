<?php
include_once '../common/common.php';
checkLoggedIn();
error_log("file upload started");




if (isset($_POST["submit"])) {
    $path_parts = pathinfo($_FILES["profilepicture"]["name"]);
    $extension = $path_parts['extension'];
    $target_file = IMAGE_FOLDER . $_SESSION["login"] . "." . $extension;
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
        
        <div class="w3-card-4 w3-margin-top" style="width:25%">
            <img src="profilePicture.php" alt="Upload your profile picture!" style="width:100%">
            <div class="w3-container w3-center">
                <p>Your profile picture</p>
            </div>
        </div>

        <form method="POST" action="uploadprofilepicture.php" enctype="multipart/form-data" class="w3-margin-top">

            <h2 class="w3-text-theme">Upload a profile picture!</h2>
            <p>You can only upload a jpg or a png file.</p>

            <p>
                <label class="w3-text-theme"><b>Your picture</b></label>
                <input class="w3-input w3-border" name="profilepicture" type="file">
            </p>
            <p>
                <input type="submit" name="submit" class="w3-btn w3-theme" value="Upload">
            </p>

        </form>

    </div>

</body>

</html>