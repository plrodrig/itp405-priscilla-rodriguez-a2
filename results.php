<?php
if(!isset($_GET['dvd_title'])){
  header('Location: index.php');
  exit();
}
$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pw = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pw);

$dvd_title = $_GET['dvd_title'];


$sql = "
  SELECT title, genre_name, format_name, rating_name
  FROM dvds
  INNER JOIN genres
  ON dvds.genre_id = genres.id
  INNER JOIN formats
  ON dvds.format_id = formats.id
  INNER JOIN ratings
  ON dvds.rating_id = ratings.id
  WHERE title LIKE ?

";
$statement = $pdo->prepare($sql);
$like = '%' . $dvd_title . '%';
$statement->bindParam(1, $like);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);
//No results are returned from the query
if(!$dvds){
  echo "No results found.";
}
?>

<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title> Results Page</title>
  </head>
  <body>
  <?php foreach($dvds as $dvd) : ?>
    <h1>
      Title: <?php echo $dvd->title ?>
    <h1>
    <div>
    Genre: <?php echo $dvd->genre_name ?>
    </div>
    <div>
    Format: <?php echo $dvd->format_name ?>
    </div>
    <div>

    Rating: <a href="ratings.php?rating=<?php echo $dvd->rating_name ?>"> <?php echo $dvd->rating_name ?> </a>
    </div>
  <?php endforeach; ?>
  </body>

</html>
