<?php
include_once '../common/common.php';
function findMovies($title, $description, $genre, $id)
{
  $db = include '../common/db.php';
  $conditions = 0;
  $sql = "select description, title, genre, id from movie ";
  if (!empty($title)) {
    appendCondition($sql, $conditions);
    $conditions++;
    $sql .= ("title LIKE '%") . ($title) . ("%'");
  }
  if (!empty($description)) {
    appendCondition($sql, $conditions);
    $conditions++;
    $sql .= ("description LIKE '%") . ($description) . ("%'");
  }
  if (!empty($genre)) {
    appendCondition($sql, $conditions);
    $conditions++;
    $sql .= ("genre LIKE '%") . ($genre) . ("%'");
  }
  if (!empty($id)) {
    appendCondition($sql, $conditions);
    $conditions++;
    $sql .= "id = '" . ($id) . ("'");
  }


  $statement = $db->query($sql);
  //$statement->execute();
  return $statement;
}

function appendCondition(&$sql, $conditions)
{
  if ($conditions == 0) {
    $sql .= " where ";
  } else {
    $sql .= " and ";
  }
}
?>

<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="../js/movie.js"></script>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
    <?=getMyTheme()?>
</style>

<body>

  <div class="w3-container">
    <?php include '../menu.php'; ?>
    <h2>Movies of the database</h2>

    <form action="movielist.php" method="GET" class="">

      <div class="w3-row-padding">
        <div class="w3-half">
          <label class="w3-text-theme"><b>Id</b></label>
          <input class="w3-input w3-border" name="id" value="<?=$_GET["id"];?>" type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Title</b></label>
          <input class="w3-input w3-border" name="title" value="<?=$_GET["title"];?>" type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Description</b></label>
          <input class="w3-input w3-border" name="description" value="<?=$_GET["description"];?>" type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Genre</b></label>
          <input class="w3-input w3-border" name="genre" value="<?=$_GET["genre"];?>" type="text">
        </div>
      </div>

      <p>
        <button class="w3-btn w3-theme" <?=hideIfNotLoggedIn()?>>Filter</button>
        <button class="w3-btn w3-theme" id="newMovieButton" onclick="return false;">New movie</button>
      </p>

    </form>

    <div id="newMovieForm" style="display: none;">
    <h1>Add a new movie to the database!</h1>
    <div class="w3-row-padding">
        <div class="w3-half">
          <label class="w3-text-theme"><b>Id</b></label>
          <input class="w3-input w3-border" name="newMovieId" id="newMovieId"  type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Title</b></label>
          <input class="w3-input w3-border" name="newMovieTitle" id="newMovieTitle"  type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Description</b></label>
          <input class="w3-input w3-border" name="newMovieDesc" id="newMovieDesc"  type="text">
        </div>
        <div class="w3-half">
          <label class="w3-text-theme"><b>Genre</b></label>
          <input class="w3-input w3-border" name="newMovieGenre" id="newMovieGenre"  type="text">
        </div>
      </div>
      <p>
        <button class="w3-btn w3-theme" id="addMovieButton">Add</button>
      </p>
    </div>


    <table class="w3-table-all w3-striped" id="movieTable">
      <tr id="movieTableHead">
        <th class="w3-theme">Id</th>
        <th class="w3-theme">Title</th>
        <th class="w3-theme">Genre</th>
        <th class="w3-theme">Description</th>
      </tr>
      <?php
      $findMoviesSqlStatement = findMovies($_GET["title"], $_GET["description"], $_GET["genre"], $_GET["id"]);
      while ($row = $findMoviesSqlStatement->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["title"] . "</td>";
        echo "<td>" . $row["genre"] . "</td>";
        echo "<td>" . $row["description"] . "</td>";
        echo "</tr>";
      }
      ?>
    </table>
  </div>

</body>

</html>