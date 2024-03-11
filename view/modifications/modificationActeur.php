<?php ob_start(); ?>

<h1>Modification acteur</h1>

<div>
    <p>Modifier un acteur</p>
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
            <label>
                <input type="submit" name="submit" value="Ajouter">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Modification acteur";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";