
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/styles.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title><?= $titrePage ?></title>
    </head>
    <body >
            <header >
                <nav>
                    <ul>
                        <li class="nav-item mx-4"><a class="nav-link " href="index.php?action=listeFilms">Liste Films</a></li>
                        <li class="nav-item mx-4"><a class="nav-link " href="index.php?action=listeActeurs">Liste Acteurs</a></li>
                        <li class="nav-item mx-4"><a class="nav-link" href="index.php?action=listeRealisateurs">Liste Realisateurs</a></li>
                        <li class="nav-item mx-4"><a class="nav-link" href="index.php?action=listeGenres">Liste Genres</a></li>
                        <li class="nav-item mx-4"><a class="nav-link" href="index.php?action=listeRoles">Liste Roles</a></li>
                    </ul>
                </nav>
               
            </header>
            <main>
                <h2><?= $titreSecond ?></h2>
                <?= $content ?>
            </main>
    </body>
</html>