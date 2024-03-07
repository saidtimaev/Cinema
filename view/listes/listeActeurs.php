<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> acteurs</p>

<a href="index.php?action=ajoutActeurAffichage">Ajouter un acteur</a><br><br>

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
            foreach($requete->fetchAll() as $acteur){ ?>
                <tr>
                    <td><a href="index.php?id=<?= $acteur["id_acteur"] ?>&action=infosActeur"><?php echo $acteur["personne_prenom"] ?></a></td>
                    <td><a href="index.php?id=<?= $acteur["id_acteur"] ?>&action=infosActeur"><?php echo $acteur["personne_nom"] ?></a></td>
                    <td><?= $acteur["personne_date_naissance"] ?></td>
                    <td><?= $acteur["personne_sexe"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titrePage = "Liste d'acteurs";
$titreSecond = "Liste d'acteurs";
$content = ob_get_clean();
require "view/template.php";