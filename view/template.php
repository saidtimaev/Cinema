
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/styles.css">
        <title><?= $titrePage ?></title>
    </head>
    <div id="wrapper">
        <body >
           
            <header>
                <img>Logo</img>
                
                <div class="nav">
                    <nav>
                        <div class="nav-list">
                            <ul>
                                <li><a href="index.php?action=pageAccueil">Accueil</a></li>
                                <li><a href="index.php?action=listeFilms">Films</a></li>
                                <li><a href="index.php?action=listeActeurs">Acteurs</a></li>
                                <li><a href="index.php?action=listeRealisateurs">Realisateurs</a></li>
                                <li><a href="index.php?action=listeGenres">Genres</a></li>
                                <li><a href="index.php?action=listeRoles">Rôles</a></li>
                                <li><a href="index.php?action=listeCastings">Castings</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
                
                <div class="recherche">
                    <form>
                        <label>Recherche : </label>
                        <input type="text" name=" " value="" placeholder="Tapez votre recherche ici..">
                    </form>
                </div>
            </header>
            
            <div class="main">
                <main>
                    <?= $content ?>
                </main>
            </div>
            <div class="footer">
                <footer>
                    <div class="footer-nav">
                        <nav>
                            <div class="footer-nav-list">
                                <ul>
                                    <li><a href="">Facebook</a></li>
                                    <li><a href="">Youtube</a></li>
                                    <li><a href="">Twitter</a></li>
                                    <li><a href="">Instagram</a></li>
                                    <li><a href="">A propos</a></li>
                                    <li><a href="">Nous contacter</a></li>
                                    <li><a href="">CGU</a></li>
                                    <li><a href="">Aide</a></li>
                                    <li><a href="">Cookies</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </footer>
            </div>
        </body>
    </div>
</html>