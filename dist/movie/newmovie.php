<?php
include_once '../common/common.php';
checkLoggedIn();
header('Content-type: application/json');
$movie = json_decode(file_get_contents('php://input'), true);
if (
    notBlank($movie["title"])
    && notBlank($movie["description"])
    && notBlank($movie["genre"])
) {
    $db = include '../common/db.php';
    if (! empty($movie["id"])) {
        $query = "SELECT * FROM movie where id = :id";
        $statement = $db->prepare($query);
        $statement->execute(['id' => $movie["id"]]);
        if ($statement->rowCount() > 0) {
            header('HTTP/1.1 500 Internal Server Gotcha');
            die(json_encode(array('message' => 'Movie with this id already exists', 'id' => $movie["id"])));
        }
    }
    $id = ! empty($movie["id"]) ? $movie["id"] : uniqid();
    $statement = $db->prepare("insert into movie(id, title, description, genre) VALUES (:id, :title, :description, :genre)");
    $movieArray = ["id" => $id, "title" => $movie["title"], "description" => $movie["description"], "genre" => $movie["genre"]];
    $statement->execute($movieArray);
    echo (json_encode($movieArray));
} else {
    header('HTTP/1.1 500 Internal Server Gotcha');
    die(json_encode(array('message' => 'title, description and genre are mandatory fields')));
}
