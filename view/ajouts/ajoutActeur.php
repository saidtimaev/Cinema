<?php ob_start(); ?>

<h1>Ajout acteur</h1>

<div>
    <p>Ajouter un acteur</p>
    <form action="index.php?action=ajoutActeur" method="post">
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
            <label>
                <input type="submit" name="submit" value="Ajouter">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Ajout acteur";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";