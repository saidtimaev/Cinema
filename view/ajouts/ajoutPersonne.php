<?php ob_start(); ?>

<h1>Ajout Personne</h1>

<div>
    <p>Ajouter une personne</p>
    <form action="index.php?action=ajoutPersonne" method="post">
        <p>
            <label>
                Prénom :
                <input type="text" name="personne_prenom">
            </label>
        </p>
        <p>
            <label>
                Nom :
                <input type="text" name="personne_nom">
            </label>
        </p>
        <p>
            <label>
                Sexe :
                <input type="text" name="personne_sexe">
            </label>
        </p>
        <p>
            <label>
                Date de naissance :
                <input type="date" name="personne_date_naissance">
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
                <input type="submit" name="submit" value="Ajouter">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Ajout personne";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";