<?php ob_start(); ?>



<section>
    <div class="liste-films">
        <p>Il y a <?= $requete->rowCount() ?> films</p>
        
        <div class="table-films">
            <table>
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Sortie</th>
                        <th>Durée</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach($requete->fetchAll() as $film){ ?>
                            <tr>
                                <td><a href="index.php?id=<?= $film["id_film"] ?>&action=infosFilm"><?php echo $film["film_titre"] ?></a></td>
                                <td><?= $film["film_date_sortie"] ?></td>
                                <td><?= $film["film_duree"] ?></td>
                                <td><?= $film["film_note"] ?></td>
                            </tr>
                        <?php } ?>
                </tbody>
            </table>
        </div>
        <button class="b1"><a href="index.php?action=ajoutFilmAffichage">Ajouter un film</a></button>      
        
    </div>
    
</section>


<?php


$titrePage = "Liste des films";
$titreSecond = "Liste des films";
$content = ob_get_clean();
require "view/template.php";