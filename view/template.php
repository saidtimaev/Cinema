
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="public/css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                                    <div class="reseaux">
                                        <li><a href=""><i class="fa-brands fa-facebook-f"></i></a></li>
                                        <li><a href=""><i class="fa-brands fa-youtube"></i></a></li>
                                        <li><a href=""><i class="fa-brands fa-x-twitter"></i></a></li>
                                        <li><a href=""><i class="fa-brands fa-instagram"></i></a></li>
                                    </div>
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