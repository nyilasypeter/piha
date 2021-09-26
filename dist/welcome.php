<?php include 'common/common.php' ?>
<?php checkLoggedIn(); ?>
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
    <?php include 'menu.php'; ?>
    <div class="w3-display-middle">
        <h1>Welcome movie-fan at this fantastic movie database!</h1>
    </div>
    
</div>

</body>

</html>