<?php ob_start(); ?>


<a href="index.php?action=ajoutCastingFilm">Ajouter un casting</a><br><br>


<table>
    <thead>
        <tr>
            <th>Film</th>
            <th>Rôle</th>
            <th>Acteur</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $castingFilm){ ?>
                <tr>
                    <td><?php echo $castingFilm["film_titre"] ?></td>
                    <td><?= $castingFilm["role_nom"] ?></td>
                    <td><?= $castingFilm["personne_prenom"]. " ".$castingFilm["personne_nom"] ?></td>
                  
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php


$titrePage = "Liste des castings";
$titreSecond = "Liste des castings";
$content = ob_get_clean();
require "view/template.php";