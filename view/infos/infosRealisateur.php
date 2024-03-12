<?php ob_start(); ?>

<?php $realisateur = $requeteInfosRealisateur->fetch();  
?>

<a href="index.php?action=modificationPersonneAffichage&id=<?= $id ?>">Modifier ce réalisateur</a><br><br>


<h1><?php echo $realisateur["personne_prenom"]." ".$realisateur["personne_nom"]."<br>"; ?> </h1>
<p>Date de naissance : <?php echo $realisateur["personne_date_naissance"]; ?></p>
<p>Genre : <?php echo $realisateur["personne_sexe"]; ?></p>


   


<p>Liste des films que <?php echo $realisateur["personne_prenom"]." ".$realisateur["personne_nom"]; ?>  a réalisé :</p>
<p>Nombre de films : <?= $requeteRealisateurFilms->rowCount() ?></p>
<table>
    <thead>
        <tr>
            <th>Film</th>
            
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteRealisateurFilms->fetchAll() as $realisateurFilm){ ?>
                <tr>
                    <td><?php echo $realisateurFilm["film_titre"]; ?></td>
                    <td><?php echo $realisateurFilm["film_date_sortie"]; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>

<?php

$titrePage = $realisateur["personne_prenom"]." ".$realisateur["personne_nom"];
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";