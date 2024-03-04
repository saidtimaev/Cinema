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
                    <td><?= $genre["genre_libelle"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$pageActive = '<li class="nav-item mx-4"><a class="nav-link " href="listeFilms.php">Liste Films</a></li>
               <li class="nav-item mx-4"><a class="nav-link " href="listeActeurs.php">Liste Acteurs</a></li>
               <li class="nav-item mx-4"><a class="nav-link" href="listeRealisateurs.php">Liste Realisateurs</a></li>
               <li class="nav-item mx-4"><a class="nav-link active" aria-current="page" href="listeGenres.php">Liste Genres</a></li>
               ';
$titrePage = "Liste de genres";
$titreSecond = "Liste de genres";
$content = ob_get_clean();
require "view/template.php";