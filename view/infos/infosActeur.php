<?php ob_start(); ?>

<?php $acteur = $requeteInfosActeur->fetch();  
?>

<a href="index.php?action=modificationPersonneAffichage&id=<?= $id ?>">Modifier cet acteur</a><br><br>

<h1><?php echo $acteur["personne_prenom"]." ".$acteur["personne_nom"]."<br>"; ?> </h1>
<p>Date de naissance : <?php echo $acteur["personne_date_naissance"]; ?></p>
<p>Genre : <?php echo $acteur["personne_sexe"]; ?></p>


   


<p>Liste des rôles que <?php echo $acteur["personne_prenom"]." ".$acteur["personne_nom"]; ?>  a joué :</p>
<p>Nombre de rôles : <?= $requeteActeurCastings->rowCount() ?></p>
<table>
    <thead>
        <tr>
            <th>Film</th>
            <th>Rôle</th>
            <th>Année de sortie</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteActeurCastings->fetchAll() as $acteurCasting){ ?>
                <tr>
                    <td><?php echo $acteurCasting["film_titre"]; ?></td>
                    <td><?php echo $acteurCasting["role_nom"]; ?></td>
                    <td><?php echo $acteurCasting["film_date_sortie"]; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>

<?php

$titrePage = $acteur["personne_prenom"]." ".$acteur["personne_nom"];
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";