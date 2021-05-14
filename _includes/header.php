<?php

// ON RECUPERE LES CATEGORIES
$reqGenres = $bdd->prepare("SELECT * FROM genre ORDER BY genre_name ASC");
$reqGenres->execute();
$genres = $reqGenres->fetchAll(PDO::FETCH_ASSOC);

// ON RECUPERE LES POSTES DE TRAVAIL
$reqDepartments = $bdd->prepare("SELECT * FROM department ORDER BY department_id DESC");
$reqDepartments->execute();
$departments = $reqDepartments->fetchAll(PDO::FETCH_ASSOC);

$reqNbMoviesPerCat = $bdd->prepare("SELECT movie_genres.genre_id, COUNT(*) AS nb_movies FROM movie_genres INNER JOIN genre ON genre.genre_id = movie_genres.genre_id GROUP BY movie_genres.genre_id");
$reqNbMoviesPerCat->execute();
$nbMoviesPerCat = $reqNbMoviesPerCat->fetchAll(PDO::FETCH_GROUP);
?>



<nav class="navbar is-primary" role="navigation" aria-label="main navigation">
<div class="container">
    <div class="navbar-brand">
        <a class="navbar-item is-size-3" href="/">
            Movie database
        </a>

        <a role="button" class="navbar-burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
            <span aria-hidden="true"></span>
        </a>
    </div>

    <div id="navbarBasicExample" class="navbar-menu">
        <div class="navbar-end">
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Categories
                </a>
                <div class="navbar-dropdown">
                    <a class="navbar-item" href="/">All categories</a>
                    <hr class="dropdown-divider">
                    <?php foreach ($genres as $categorie):?>
                        <a class="navbar-item" href="category.php?id=<?= $categorie['genre_id'] ?>">
                            <span class="has-text-weight-semibold"><?= $categorie['genre_name'] ?></span> 
                            &nbsp; (<?= $nbMoviesPerCat[$categorie['genre_id']][0]['nb_movies'] ?>)
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="navbar-item has-dropdown is-hoverable">
                <a class="navbar-link">
                    Cast Members
                </a>
                <div class="navbar-dropdown">
                    <?php foreach ($departments as $department):?>
                        <a class="navbar-item" href="department.php?id=<?= $department['department_id'] ?>">
                            <span class="has-text-weight-semibold"><?= $department['department_name'] ?></span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        
    </div>
</div>
</nav>