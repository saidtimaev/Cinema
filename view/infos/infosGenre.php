<?php ob_start(); ?>
<?php $genre = $requeteInfosGenre->fetch();  
?>

<h1><?php echo $genre["genre_libelle"]."<br>"; ?> </h1>

<a href="index.php?action=modificationGenreAffichage&id=<?= $id ?>">Modifier ce genre</a><br><br>
<a href="index.php?id=<?= $genre["id_genre"] ?>&action=supprimerGenre">Supprimer ce genre</a>

   


<p>Liste des films du genre <?php echo $genre["genre_libelle"]; ?> :</p>

<p>Il y a <?= $requeteFilmsGenre->rowCount() ?> films</p>

<table>
    <thead>
        <tr>
            <th>Film</th>
            <th>Date de sortie</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteFilmsGenre->fetchAll() as $filmGenre){ ?>
                <tr>
                    <td><?php echo $filmGenre["film_titre"]; ?></td>
                    <td><?php echo $filmGenre["film_date_sortie"]; ?></td>
                </tr>
            <?php } ?>
    </tbody>
    
</table>

<?php

$titrePage = $genre["genre_libelle"];
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";