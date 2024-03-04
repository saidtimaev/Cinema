<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Realisateurs</p>

<table>
    <thead>
        <tr>
            <th>Prenom</th>
            <th>Nom</th>
            <th>Date de naissance</th>
            <th>Genre</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $realisateur){ ?>
                <tr>
                    <td><?= $realisateur["personne_prenom"] ?></td>
                    <td><?= $realisateur["personne_nom"] ?></td>
                    <td><?= $realisateur["personne_date_naissance"] ?></td>
                    <td><?= $realisateur["personne_sexe"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$pageActive = '<li class="nav-item mx-4"><a class="nav-link " href="listeFilms.php">Liste Films</a></li>
               <li class="nav-item mx-4"><a class="nav-link " href="listeActeurs.php">Liste Acteurs</a></li>
               <li class="nav-item mx-4"><a class="nav-link active" aria-current="page" href="listeRealisateurs.php">Liste Realisateurs</a></li>
               <li class="nav-item mx-4"><a class="nav-link" href="listeGenres.php">Liste Genres</a></li>
               ';
$titrePage = "Liste de realisateurs";
$titreSecond = "Liste de realisateurs";
$content = ob_get_clean();
require "view/template.php";