<?php

require("connect/db.php");

// ON RECUPERE LA LISTE DES FILMS
$reqMovies = $bdd->prepare("SELECT * FROM movie ORDER BY RAND() LIMIT 40");
$reqMovies->execute();
$movies = $reqMovies->fetchAll(PDO::FETCH_ASSOC);

// ON CAPTE LA COLONNE QUI SERVIRA AU TRI PUIS ON APPLIQUE L'ORDRE EN FONCTION D'ELLE
$revenue = array_column($movies, "revenue");
array_multisort($revenue, SORT_DESC, $movies);


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Open Movie Db</title>
    <link href="node_modules/bulma/css/bulma.css" rel="stylesheet" crossorigin="anonymous">
    <link href="node_modules/vanilla-datatables/dist/vanilla-dataTables.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <?php require("_includes/header.php"); ?>

    <section class="mt-4" id="listFilms">
        <div class="container">
            <div class="row">
                <div class="col">
                    <?php include("_includes/results.php"); ?>
                </div>
            </div>
        </div>
    </section>

<?php require("_includes/footer.php"); ?>
</body>

</html>