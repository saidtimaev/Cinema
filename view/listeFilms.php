<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> films</p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date de sortie</th>
            <th>Durée</th>
            <th>Note</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $film){ ?>
                <tr>
                    <td><?= $film["film_titre"] ?></td>
                    <td><?= $film["film_date_sortie"] ?></td>
                    <td><?= $film["film_duree"] ?></td>
                    <td><?= $film["film_note"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$pageActive = '<li class="nav-item mx-4"><a class="nav-link active" aria-current="page" href="listeFilms.php">Liste Films</a></li>
                <li class="nav-item mx-4"><a class="nav-link " href="listeActeurs.php">Liste Acteurs</a></li>
                <li class="nav-item mx-4"><a class="nav-link" href="listeRealisateurs.php">Liste Realisateurs</a></li>
               ';
$titrePage = "Liste des films";
$titreSecond = "Liste des films";
$content = ob_get_clean();
require "view/template.php";