<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Realisateurs</p>


<a href="index.php?action=ajoutRealisateurAffichage">Ajouter un réalisateur</a><br><br>


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
                    <td><a href="index.php?id=<?= $realisateur["id_realisateur"] ?>&action=infosRealisateur"><?php echo $realisateur["personne_prenom"] ?></a></td>
                    <td><a href="index.php?id=<?= $realisateur["id_realisateur"] ?>&action=infosRealisateur"><?php echo $realisateur["personne_nom"] ?></a></td>
                    <td><?= $realisateur["personne_date_naissance"] ?></td>
                    <td><?= $realisateur["personne_sexe"] ?></td>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titrePage = "Liste de realisateurs";
$titreSecond = "Liste de realisateurs";
$content = ob_get_clean();
require "view/template.php";