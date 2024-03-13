<?php ob_start();

$film = $requeteInfosFilm->fetch();

$genresFilm =  $requeteRechercheGenresFilm->fetchAll();

$idRealisateurFilm = $requeteRealisateurFilm->fetch();

$genres = [];
foreach($genresFilm as $genre){
    $genres[]= $genre['id_genre'];
}

var_dump($film["film_date_sortie"]);


?>

<h1>Modification film</h1>


<div>
    <p>Modifier un film</p>
    <form action="index.php?action=modificationFilm&id=<?= $id ?>" method="post">
        <p>
            <label>
                Titre :
                <input type="text" name="film_titre" value="<?=$film["film_titre"]?>">
            </label>
        </p>
        <p>
            <label>
                Note :
                <input type="number" name="film_note" min="0" value="<?=$film["film_note"]?>">
            </label>
        </p>
        <p>
            <label>
                Durée en minutes :
                <input type="number" name="film_duree" value="<?=$film["film_duree"]?>">
            </label>
        </p>
        <p>
            <label>
                Date de sortie :
                <?php

                    // On transforme notre chaîne de caractères en un tableau
                    $toarray =explode("/",$film["film_date_sortie"]);
                    // On inverse l'ordre des éléments
                    $reverse = array_reverse($toarray);
                    // On assemble une chaîne de caractères à partir d'éléments d'un tableau
                    $final = implode("-",$reverse);


                ?>
                <input type="date" name="film_date_sortie" value="<?= $final ?>">
            </label>
        </p>
        <p>
            <legend>Genre(s) :</legend>
            <?php foreach($requeteListeGenres->fetchAll() as $genre){ 
                $genreCheck = (in_array($genre["id_genre"], $genres)) ? "checked" : "";
                
                ?>
                    <input type="checkbox" id="<?= $genre["id_genre"] ?>" name="genres[]" value="<?= $genre["id_genre"] ?>" <?= $genreCheck ?>>
                    <label for="<?= $genre["id_genre"] ?>"><?= $genre["genre_libelle"]?></label><br>
            <?php } ?>
        </p>
        <p>
                <label> Résumé : </label>
                <textarea id="synopsis" name="film_synopsis" rows="5" cols="33" value=""><?=$film["film_synopsis"]?></textarea>
        </p>
        <p>
            <label for="realisateur-choix">Réalisateur</label>
            <select name="id_realisateur" id="realisateur-choix">
                <option value="">Choix</option>
                <?php foreach($requeteListeRealisateurs->fetchAll() as $realisateur){ 
                    $realisateurCheck = (in_array($realisateur["id_realisateur"],$idRealisateurFilm)) ? "selected='selected'" : "";
                    ?>
                    <option value="<?= $realisateur["id_realisateur"] ?>" <?= $realisateurCheck ?>><?= $realisateur["personne_prenom"]. " ".$realisateur["personne_nom"] ?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="film_affiche">Affiche :</label>
            <input type="text" name="film_affiche" value="<?=$film["film_affiche"]?>" />
        </p>
        <p>
            <label>
                <input type="submit" name="submit" value="Modifier">
            </label>
        </p>
    </form>

  
</div>

<p>Liste des rôles et des acteurs :</p>

<p>Il y a <?= $requeteActeursRoles->rowCount() ?> acteurs</p>

<table>
    <thead>
        <tr>
            <th>Acteur</th>
            <th>Rôle</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tbody>
    <?php 
            foreach($requeteActeursRoles->fetchAll() as $acteurRole){ ?>
                <tr>
                    <td><?php echo $acteurRole["personne_prenom"]." ".$acteurRole["personne_nom"]; ?></td>
                    <td><?php echo $acteurRole["role_nom"]; ?></td>
                    <td><a href="index.php?action=suppressionCasting&id_film=<?= $acteurRole["id_film"]?>&id_role=<?= $acteurRole["id_role"]?>&id_acteur=<?= $acteurRole["id_acteur"]?>">X</a></td>
                </tr>
            <?php } 
            
            ?>
    </tbody>
    
</table>




<?php

$titrePage = "Modification film";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";