<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Genres</p>

<table>
    <thead>
        <tr>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $genre){ ?>
                <tr>
                    <td><a href="index.php?id=<?= $genre["id_genre"] ?>&action=infosGenre"><?= $genre["genre_libelle"] ?></a></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titrePage = "Liste de genres";
$titreSecond = "Liste de genres";
$content = ob_get_clean();
require "view/template.php";