<?php ob_start(); ?>

<h1>Ajout genre</h1>

<div>
    <h1>Ajouter un genre</h1>
    <form action="traitement.php" method="post">
        <p>
            <label>
                Libellé du genre :
                <input type="text" name="genre_libelle">
            </label>
        </p>
    </form>
</div>

   




<?php

$titrePage = "Ajout genre";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";