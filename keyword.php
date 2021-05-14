<?php

require("connect/db.php");

// ON RECUPERE LA LISTE DES FILMS
$reqMoviesByKeyword = $bdd->prepare("SELECT * FROM movie_keywords INNER JOIN movie ON movie.movie_id = movie_keywords.movie_id INNER JOIN keyword ON keyword.keyword_id = movie_keywords.keyword_id WHERE movie_keywords.keyword_id = ? ORDER BY movie.budget DESC");
$reqMoviesByKeyword->execute( [ htmlspecialchars($_GET['id']) ] );
$movies = $reqMoviesByKeyword->fetchAll();

$keyword = $movies[0]['keyword_name'];
// var_dump($movies); die;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot clé : <?= $keyword ?></title>
    <link href="node_modules/bulma/css/bulma.css" rel="stylesheet" crossorigin="anonymous">
    <link href="node_modules/vanilla-datatables/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require("_includes/header.php"); ?>


    <section class="mt-4" id="categoriesFilms">
        <div class="container">
            <h2 class="is-size-3 mb-4">Mot clé : <span class="has-text-success"><?= $keyword ?></span></h2>
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