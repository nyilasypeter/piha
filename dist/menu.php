<?php 
  include_once 'common/common.php';
  include_once 'common/constants.php';
?>
<div class="w3-bar w3-theme">
  <a <?=hideIfNotLoggedIn()?> href="<?= CONTEXT_ROOT . '/welcome.php' ?>" class="w3-bar-item w3-button">Home</a>
  <a href="<?= CONTEXT_ROOT . '/movie/movielist.php' ?>" class="w3-bar-item w3-button">Movies</a>
  <div class="w3-dropdown-hover" <?=hideIfNotLoggedIn()?>>
    <button class="w3-button">Profile</button>
    <div class="w3-dropdown-content w3-bar-block w3-card-4" >
      <a href="<?= CONTEXT_ROOT . '/user/changePassword.php' ?>" class="w3-bar-item w3-button">Change password</a>
      <a href="<?= CONTEXT_ROOT . '/user/myprofile.php' ?>" class="w3-bar-item w3-button">My profile</a>
      <a href="<?= CONTEXT_ROOT . '/user/uploadprofilepicture.php' ?>" class="w3-bar-item w3-button">My profile picture</a>
      <a href="<?= CONTEXT_ROOT . '/user/userprofiles.php' ?>" class="w3-bar-item w3-button">Other user's profiles</a>
    </div>
  </div>
  <a <?=hideIfNotLoggedIn()?> href="<?= CONTEXT_ROOT . '/logout.php' ?>" class="w3-bar-item w3-button w3-theme w3-right">Log out</a>
  <a <?=hideIfLoggedIn()?> href="<?= CONTEXT_ROOT . '/login.php' ?>" class="w3-bar-item w3-button w3-theme w3-right">Log in</a>
</div>