<?php ob_start();
?>

<h1>Ajout film</h1>


<div>
    <p>Ajouter un film</p>
    <form action="index.php?action=ajoutFilm" method="post">
        <p>
            <label>
                Titre :
                <input type="text" name="film_titre">
            </label>
        </p>
        <p>
            <label>
                Note :
                <input type="text" name="film_note">
            </label>
        </p>
        <p>
            <label>
                Durée en minutes :
                <input type="text" name="film_duree">
            </label>
        </p>
        <p>
            <legend>Genre(s) :</legend>
            <?php foreach($requeteListeGenres->fetchAll() as $genre){ ?>
                <div>
                    <input type="checkbox" id="<?= $genre["id_genre"] ?>" name="<?= $genre["id_genre"] ?>"  />
                    <label for="<?= $genre["id_genre"] ?>"><?= $genre["genre_libelle"]?></label>
                </div>
            <?php } ?>
        </p>
        <p>
            <label>
                Résumé :
                <input type="text" name="film_resume">
            </label>
        </p>
        
        <p>
            <label for="realisateur-choix">Réalisateur</label>
            <select name="realisateur" id="realisateur-choix">
                <option value="">Choix</option>
                <?php foreach($requeteListeRealisateurs->fetchAll() as $realisateur){ ?>
                    <option value="<?= $realisateur["id_realisateur"] ?>"><?= $realisateur["personne_prenom"]. " ".$realisateur["personne_nom"] ?></option>
                <?php } ?>
            </select>
           
        </p>
        <p>
            <label for="affiche">Affiche :</label>
            <input type="file" id="affiche" name="affiche" accept="image/png, image/jpeg" />
        </p>
        <p>
            <label>
                <input type="submit" name="submit" value="Ajouter">
            </label>
        </p>

    </form>
</div>

   




<?php

$titrePage = "Ajout film";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";