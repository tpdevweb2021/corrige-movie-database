<table class="table table-container is-bordered is-striped is-fullwidth" id="resultTable">
    <thead>
        <tr>
            <th>Movie name</th>
            <th>Popularity</th>
            <th class="has-text-centered">Budget (€)</th>
            <th class="has-text-centered">Revenue (€)</th>
            <th class="has-text-centered">Benefits (€)</th>
            <th class="has-text-centered">Benefit Coeff</th>
            <th class="has-text-centered" data-type="date" data-format="DD/MM/YYYY">Release Date</th>
            <th class="has-text-centered">Runtime (min.)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach ($movies as $movie):
                $benefits = (int) $movie['revenue'] - (int) $movie['budget'];
                $benefitsCoeff = ($movie['revenue'] > 0 && $movie['budget'] > 0) ? (int) $movie['revenue'] / (int) $movie['budget'] : 0;
                $colorBenefits = $benefits >= 0 ? "has-text-success" : "has-text-danger";
        ?>
        <tr>
            <td>
                <a href="movie.php?id=<?= $movie['movie_id'] ?>">
                    <span class="fw-bold"> <?= $movie['title'] ?></span>
                </a>
            </td>
            <td align="center"><?= round($movie['popularity'], 2) ?></td>
            <td align="center">
                <?=  number_format( (int) $movie['budget'], 0, ",", " ") ?>
            </td>
            <td align="center">
                <?=  number_format( (int) $movie['revenue'], 0, ",", " ") ?>
            </td>
            <td align="center">
                <span class="<?= $colorBenefits ?>">
                    <?= number_format( (int) $benefits , 0, ",", " ") ?>
                </span>
            </td>
            <td align="center">
                <span class="<?= $colorBenefits ?>">
                    <?= number_format( (float) $benefitsCoeff , 2, ",", " ") ?>
                </span>
            </td>
            <td align="center"><?= $movie['release_date'] ?></td>
            <td align="center"><?= $movie['runtime'] ?></td>
            <td align="center"><a href="movie.php?id=<?= $movie['movie_id'] ?>"
                    class="button is-small is-info">More info</a></td>
        </tr>
        <?php
            endforeach;
        ?>
    </tbody>
</table>