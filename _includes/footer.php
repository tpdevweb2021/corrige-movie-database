<?php

// ON AFFICHE 12 MOTS CLES AU HASARD
$reqKeywordsFooter = $bdd->prepare("SELECT * FROM movie_keywords INNER JOIN keyword ON keyword.keyword_id = movie_keywords.keyword_id ORDER BY RAND() LIMIT 12");
$reqKeywordsFooter->execute();
$keywords = $reqKeywordsFooter->fetchAll(PDO::FETCH_ASSOC);
$arrayKeywords = [];
foreach ($keywords as $keyword) {
    $arrayKeywords[$keyword['keyword_id']] = "<a href='keyword.php?id={$keyword['keyword_id']}'>{$keyword['keyword_name']}</a>";
}
// var_dump($keywords); die;
?>

<footer class="footer-black" id="footStick">
    <div class="container">
        <div class="columns">
            <div class="column has-text-centered">
                <p>Some keywords to search good movies :-)</p>
                <p><?= implode(" - ", $arrayKeywords) ?></p>
            </div>
        </div>
    </div>
</footer>

<?php $bdd = null; ?>
<script src="node_modules/vanilla-datatables/dist/vanilla-dataTables.min.js" type="text/javascript"></script>
<script src="assets/js/app.js"></script>
<script src="assets/js/datatables.js"></script>