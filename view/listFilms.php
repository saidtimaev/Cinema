<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> films</p>

<table>
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $film){ ?>
                <tr>
                    <td><?= $film["film_titre"] ?></td>
                    <td><?= $film["film_date_sortie"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$pageActive = '<li class="nav-item mx-4"><a class="nav-link active" aria-current="page" href="listFilms.php">Liste Films</a></li>
               ';
$titrePage = "Liste des films";
$titreSecond = "Liste des films";
$content = ob_get_clean();
require "view/template.php";