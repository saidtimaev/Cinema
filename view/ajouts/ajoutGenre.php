<?php ob_start(); ?>

<h1>Ajout genre</h1>

<div>
    <p>Ajouter un genre</p>
    <form action="index.php?action=ajoutGenre" method="post">
        <p>
            <label>
                Libellé du genre :
                <input type="text" name="genre_libelle">
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

$titrePage = "Ajout genre";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";