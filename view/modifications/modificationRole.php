<?php ob_start(); ?>
<?php 

$nomRole = $requeteNomRole->fetch(); ?>

<h1>Modification rôle</h1>

<div>
    <p>Modifier un rôle</p>
    <form action="index.php?action=modificationRole&id=<?= $nomRole["id_role"] ?>" method="post">
        <p>
            <label>
                Nom du rôle :
                <input type="text" name="role_nom" value="<?= $nomRole["role_nom"] ?>">
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

$titrePage = "Modification rôle";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";