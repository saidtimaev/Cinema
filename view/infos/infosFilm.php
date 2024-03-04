<?php ob_start(); ?>
<?php $film = $requeteInfosFilm->fetch();  ?>
<p><?php echo "Infos"; ?></p>

<table>
    <thead>
        <tr>
            <th>Titre</th>
            <th>Date de sortie</th>
            <th>Durée</th>
            <th>Note</th>
            <th>Résumé</th>
            <th>Prénom réalisateur</th>
            <th>Nom réalisateur</th>
        </tr>
    </thead>
    <tbody>
        
                <tr>
                    <td><?php echo $film["film_titre"]; ?></td>
                    <td><?php echo $film["film_date_sortie"]; ?></td>
                    <td><?php echo $film["film_duree"]; ?></td>
                    <td><?php echo $film["film_note"]; ?></td>
                    <td><?php echo $film["film_synopsis"]; ?></td>
                    <td><?php echo $film["personne_prenom"]; ?></td>
                    <td><?php echo $film["personne_nom"]; ?></td>
                    
                </tr>
            
    </tbody>
</table>

<p>Liste des rôles et des acteurs</p>

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
$titreSecond = $film["film_titre"];
$content = ob_get_clean();
require "view/template.php";