<?php ob_start(); ?>

<h1>Ajout réalisateur</h1>

<div>
    <p>Ajouter un réalisateur</p>
    <form action="index.php?action=ajoutRealisateur" method="post">
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

$titrePage = "Ajout réalisateur";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";