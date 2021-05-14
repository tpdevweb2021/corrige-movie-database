<?php

require("connect/db.php");

// ON RECUPERE LA LISTE DES FILMS
$reqMoviesByGenre = $bdd->prepare("SELECT * FROM movie_genres INNER JOIN movie ON movie.movie_id = movie_genres.movie_id INNER JOIN genre ON genre.genre_id = movie_genres.genre_id WHERE movie_genres.genre_id = ? ORDER BY movie.budget DESC");
$reqMoviesByGenre->execute( [ htmlspecialchars($_GET['id']) ] );
$movies = $reqMoviesByGenre->fetchAll();

$genre = $movies[0]['genre_name'];
// var_dump($movies); die;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="node_modules/bulma/css/bulma.css" rel="stylesheet" crossorigin="anonymous">
    <link href="node_modules/vanilla-datatables/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require("_includes/header.php"); ?>


    <section class="mt-4" id="categoriesFilms">
        <div class="container">
            <h2 class="is-size-3 mb-4">Catégorie : <span class="has-text-success"><?= $genre ?></span></h2>
            <div class="columns">
                <div class="column">
                    <?php include("_includes/results.php"); ?>
                </div>
            </div>
        </div>
    </section>


    <?php require("_includes/footer.php"); ?>
</body>

</html>