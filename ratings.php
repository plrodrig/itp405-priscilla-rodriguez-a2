<?php

$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pw = 'ttrojan';

$pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pw);

$dvd_rating = $_GET['rating'];

$sql = "
  SELECT title, rating_name
  FROM dvds
  INNER JOIN ratings
  ON dvds.rating_id = ratings.id
  WHERE rating_name LIKE ?
";

$statement = $pdo->prepare($sql);
$statement->bindParam(1, $dvd_rating);
$statement->execute();
$dvds = $statement->fetchAll(PDO::FETCH_OBJ);

?>
<!--shows all dvds for the particular rating picked-->
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <title> Ratings </title>
      <link rel="stylesheet" type="text/css" href="styles.css">
  </head>
  <body>
    <div id="container">
    <h1>Ratings</h1>

    <?php foreach($dvds as $dvd) : ?>
      <div>
      <?php echo $dvd->title ?>
    </div>
    <?php endforeach; ?>
   </div>
  </body>
</html>
