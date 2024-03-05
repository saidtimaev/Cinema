<?php ob_start(); ?>

<p>Il y a <?= $requete->rowCount() ?> Rôles</p>

<table>
    <thead>
        <tr>
            <th>Rôle</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            foreach($requete->fetchAll() as $role){ ?>
                <tr>
                    <td><a href="index.php?id=<?= $role["id_role"] ?>&action=infosRole"><?= $role["role_nom"] ?></a></td>
                </tr>
                </tr>
            <?php } ?>
    </tbody>
</table>

<?php

$titrePage = "Liste des rôles";
$titreSecond = "Liste des rôles";
$content = ob_get_clean();
require "view/template.php";