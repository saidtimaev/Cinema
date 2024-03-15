<?php ob_start(); ?>

<?php $film = $requeteInfosFilm->fetch();
// var_dump($film);  
    $realisateur = $requeteInfosRealisateurFilm->fetch();
    // var_dump($realisateur);die;
   
?>

<a href="index.php?action=modificationFilmAffichage&id=<?= $id ?>">Modifier ce film</a><br><br>
<a href="index.php?action=supprimerFilm&id=<?= $id ?>">Supprimer ce film</a><br><br>


<h1><?php echo $film["film_titre"]."<br>"; ?> </h1>
<p>Date de Sortie : <?php echo $film["film_date_sortie"]; ?></p>
<p>Durée : <?php echo $film["film_duree"]; ?> min</p>
<p>Note : <?php echo $film["film_note"]; ?></p>
<p>Resumé : <br><?php echo $film["film_synopsis"]; ?></p>
<p>Réalisateur : <?= $realisateur['realisateurFilm']?? "Pas de réalisateur" ?></p>


<p>Liste des rôles et des acteurs :</p>

<p>Il y a <?= $requeteActeursRoles->rowCount() ?> acteurs</p>

<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteActeursRoles->fetchAll() as $acteurRole){ ?>
                <tr>
                    <td><?php echo $acteurRole["personne_prenom"]." ".$acteurRole["personne_nom"]; ?></td>
                    <td><?php echo $acteurRole["role_nom"]; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>

<?php

$titrePage = $film["film_titre"];
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";