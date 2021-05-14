<?php

require("connect/db.php");

// ON RECUPERE LA LISTE DES FILMS
$reqPersonsByDepartment = $bdd->prepare("SELECT * FROM movie_crew JOIN person ON person.person_id = movie_crew.person_id JOIN department ON department.department_id = movie_crew.department_id WHERE movie_crew.department_id = ? GROUP BY movie_crew.person_id ORDER BY RAND()");
$reqPersonsByDepartment->execute( [ htmlspecialchars($_GET['id']) ] );
$persons = $reqPersonsByDepartment->fetchAll();
$dept = $persons[0]['department_name'];
// var_dump($persons); die;
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

    <section class="mt-4" id="personDept">
        <div class="container">
            <h2 class="is-size-3 mb-4">Catégorie : <span class="has-text-success"><?= $dept ?></span></h2>
            <div class="columns">
                <div class="column">
                    <table class="table table-container is-striped is-bordered is-fullwidth" id="resultTable">
                        <thead>
                            <tr>
                                <th>Nom de la personne</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($persons as $person):
                            ?>
                                        <tr>
                                            <td align="center"><?= $person['person_name'] ?></td>
                                        </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>


    <?php require("_includes/footer.php"); ?>
</body>

</html>