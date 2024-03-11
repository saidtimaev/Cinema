<?php ob_start(); ?>

<h1>Modification rôle</h1>

<div>
    <p>Modifier un rôle</p>
    <form action="index.php?action=ajoutRole" method="post">
        <p>
            <label>
                Nom du rôle :
                <input type="text" name="role_nom" value=<?= $_POST["role_nom"] ?>">
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

$titrePage = "Modification rôle";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";