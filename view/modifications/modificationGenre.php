<?php ob_start(); ?>
<?php $genre = $requeteGenre->fetch(); ?>


<h1>Modification genre</h1>

<div>
    <p>Modifier un genre</p>
    <form action="index.php?action=modificationGenre&id=<?= $id ?>" method="post">
        <p>
            <label>
                Libellé du genre :
                <input type="text" name="genre_libelle" value="<?= $genre["genre_libelle"] ?>">
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

$titrePage = "Modification genre";
$titreSecond = "";
$content = ob_get_clean();
require "view/template.php";