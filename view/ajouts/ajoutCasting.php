<?php ob_start(); ?>

<h1>Ajout Casting</h1>

<div>
    <p>Ajouter un casting</p>
    <form action="index.php?action=ajoutCasting" method="post">
        
        <p>
            <label for="film-choix">Le film</label>
            <select name="film" id="film-choix">
                <option value="">Choix</option>
                <?php foreach($requeteListeFilms->fetchAll() as $film){ ?>
                    <option value="<?= $film["id_film"]?>"><?= $film["film_titre"]?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="role-choix">Le rôle</label>
            <select name="role" id="role-choix">
                <option value="">Choix</option>
                <?php foreach($requeteListeRoles->fetchAll() as $role){ ?>
                    <option value="<?= $role["id_role"]?>"><?= $role["role_nom"]?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label for="acteur-choix">L'acteur / actrice</label>
            <select name="acteur" id="acteur-choix">
                <option value="">Choix</option>
                <?php foreach($requeteListeActeurs->fetchAll() as $acteur){ ?>
                    <option value="<?= $acteur["id_acteur"]?>"><?= $acteur["personne_nom"]." ".$acteur["personne_prenom"]?></option>
                <?php } ?>
            </select>
        </p>
        <p>
            <label>
                <input type="submit" name="submit" value="Ajouter">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Ajout casting";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";