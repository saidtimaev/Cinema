<?php ob_start(); ?>

<?php $role = $requeteInfosRole->fetch();  
?>

<h1><?php echo $role["role_nom"]."<br>"; ?> </h1>



   


<p>Liste des personnes qui ont joué ce rôle :</p>

<p>Il y a <?= $requeteActeursRole->rowCount() ?> personnes</p>

<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Sexe</th>
            <th>Film</th>
            <th>Date de sortie</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteActeursRole->fetchAll() as $acteurRole){ ?>
                <tr>
                    <td><?php echo $acteurRole["personne_prenom"]." ".$acteurRole["personne_nom"]; ?></td>
                    <td><?php echo $acteurRole["personne_sexe"]; ?></td>
                    <td><?php echo $acteurRole["film_titre"]; ?></td>
                    <td><?php echo $acteurRole["film_date_sortie"]; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>

<?php

$titrePage = $role["role_nom"];
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";