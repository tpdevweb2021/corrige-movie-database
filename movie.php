<?php

require("connect/db.php");

// ON RECUPERE LES INFOS DU FILM
$reqMovie = $bdd->prepare("SELECT * FROM movie INNER JOIN movie_genres ON movie_genres.movie_id = movie.movie_id INNER JOIN genre ON genre.genre_id = movie_genres.genre_id WHERE movie.movie_id = ?");
$reqMovie->execute( [ htmlspecialchars($_GET['id']) ] );
$movie = $reqMovie->fetch(PDO::FETCH_ASSOC);

// On récupère les acteurs
$reqActors = $bdd->prepare("SELECT * FROM movie_cast INNER JOIN movie ON movie.movie_id = movie_cast.movie_id INNER JOIN person ON person.person_id = movie_cast.person_id WHERE movie_cast.movie_id = ?");
$reqActors->execute( [htmlspecialchars($_GET['id'])] );
$actors = $reqActors->fetchAll(PDO::FETCH_ASSOC);

// On récupère les employés
$reqCrews = $bdd->prepare("SELECT * FROM movie_crew INNER JOIN movie ON movie.movie_id = movie_crew.movie_id INNER JOIN person ON person.person_id = movie_crew.person_id INNER JOIN department ON department.department_id = movie_crew.department_id WHERE movie_crew.movie_id = ?");
$reqCrews->execute( [htmlspecialchars($_GET['id'])] );
$crews = $reqCrews->fetchAll(PDO::FETCH_ASSOC);

// Année de sortie
$elemDate = explode("-", $movie['release_date']);
$year = $elemDate[0];

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $movie['title'] ?></title>
    <link href="node_modules/bulma/css/bulma.css" rel="stylesheet" crossorigin="anonymous">
    <link href="node_modules/vanilla-datatables/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require("_includes/header.php"); ?>

    <section class="mt-4" id="listFilms">
        <div class="container box">
            <div class="columns is-vcentered">
                <div class="column is-9">
                    <h1 class="is-size-2"><span class="has-text-success"><?= $movie['title'] ?></span> <small class="has-text-grey-light">(<?= $year ?>)</small></h1>
                    <p> <?= !empty($movie['tagline']) ? '"' . $movie['tagline'] . '"' : '' ?> </p>
                </div>
                <div class="column has-text-right">
                <?php if(!empty($movie['homepage'])): ?>
                    <a target="_blank" href="<?= $movie['homepage'] ?>" class="button is-primary">Official Website</a>
                <?php endif; ?>
                </div>
            </div>
            
            <hr>
            <div class="columns">
                <div class="column is-9">
                    <h2 class="is-size-3 has-text-grey-light">Overview</h2>
                    <p><?= $movie['overview'] ?></p>

                    <h2 class="is-size-3 mt-5 has-text-grey-light">Acteurs</h2>
                    <div class="columns is-multiline p-3">
                        <?php foreach ($actors as $actor): ?>
                            <div class="column is-one-quarter p-1"> <?= $actor['person_name'] ?> </div>
                        <?php endforeach; ?>
                    </div>

                    <h2 class="is-size-3 mt-5 has-text-grey-light">Employés</h2>
                    <div class="columns is-multiline p-3">
                        <?php foreach ($crews as $crew): ?>
                            <div class="column is-one-third p-1"> <?= $crew['person_name'] . " (" . $crew['job'] . ")" ?> </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <div class="column">
                    <div class="is-size-4 has-text-centered py-5 box-dark mb-4">
                        <p class="is-size-4">Category : <br><a href="category.php?id=<?= $movie['genre_id'] ?>"><?= $movie['genre_name'] ?></a></p>
                    </div>
                    <div class="is-size-4 has-text-centered py-5 box-dark mb-4">
                        <span class="has-text-grey-light">Reviews</span><br>
                        <span class="is-size-3"><span class="has-text-weight-bold has-text-info"><?= $movie['vote_average'] ?></span> <small>/ 10</small></span><br>
                        <span class="is-size-5"><span class="has-text-weight-bold"><?= number_format($movie['vote_count'], 0, ".", " ") ?></span> <small>votes</small></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php require("_includes/footer.php"); ?>
</body>

</html>