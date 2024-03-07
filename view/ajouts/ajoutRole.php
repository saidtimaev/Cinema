<?php ob_start(); ?>

<h1>Ajout rôle</h1>

<div>
    <p>Ajouter un rôle</p>
    <form action="index.php?action=ajoutRole" method="post">
        <p>
            <label>
                Nom du rôle :
                <input type="text" name="role_nom">
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

$titrePage = "Ajout rôle";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";