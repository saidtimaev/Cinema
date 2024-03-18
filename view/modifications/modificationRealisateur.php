<?php ob_start(); ?>

<?php $personne = $requetePersonne->fetch() ?>

<p>Attention! Tous ces films seront affectés :</p>

<?php foreach($requeteListeFilmsRealisateur as $filmsActeur){ ?>
    <li><?= $filmsActeur["film_titre"]?></li>
<?php } ?>

<h1>Modification realisateur</h1>

<div>
    <p>Modifier un réalisateur</p>
    <form action="index.php?action=modificationRealisateur&id=<?= $personne["id_personne"] ?>" method="post">
        <p>
            <label>
                Prénom :
                <input type="text" name="personne_prenom" value="<?= $personne["personne_prenom"] ?>">
            </label>
        </p>
        <p>
            <label>
                Nom :
                <input type="text" name="personne_nom" value="<?= $personne["personne_nom"] ?>">
            </label>
        </p>
        <p>
            <label>
                Sexe :
                <input type="text" name="personne_sexe" value="<?= $personne["personne_sexe"] ?>">
            </label>
        </p>
        <p>
            <label>
                Date de naissance :
                <input type="date" name="personne_date_naissance" value="<?= $personne["personne_date_naissance"] ?>">
            </label>
        </p>
        
        <p>
            <label for="professions-choix">La / les profession(s)</label>
            <select name="professions" id="professions-choix">
                <option value="">Choix</option>
                <option value="acteur">Acteur</option>
                <option value="realisateur">Réalisateur</option>
                <option value="both">Acteur et réalisateur</option>
            </select>
        </p>
        <p>
            <label>
                Photo :
                <input type="text" name="personne_photo" value="<?= $personne["personne_photo"] ?>">
            </label>
        </p>
        <p>
            <label>
                <input type="submit" name="submit" value="Modifier">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Modification réalisateur";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";