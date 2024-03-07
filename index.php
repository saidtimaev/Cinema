

<?php

use Controller\CinemaController;


spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
if(isset($_GET["action"])){
    switch ($_GET["action"]){
        case "listeFilms" : $ctrlCinema->listeFilms(); break;
        case "listeActeurs" : $ctrlCinema->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlCinema->listeRealisateurs(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "listeRoles" : $ctrlCinema->listeRoles(); break;
        case "infosFilm" : $ctrlCinema->infosFilm($_GET['id']); break;
        case "infosActeur" : $ctrlCinema->infosActeur($_GET['id']); break;
        case "infosRealisateur" : $ctrlCinema->infosRealisateur($_GET['id']); break;
        case "infosGenre" : $ctrlCinema->infosGenre($_GET['id']); break;
        case "infosRole" : $ctrlCinema->infosRole($_GET['id']); break;
        case "ajoutGenre" : $ctrlCinema->ajoutGenre(); break;
        case "ajoutGenreAffichage" : $ctrlCinema->ajoutGenreAffichage(); break;
        case "ajoutRole" : $ctrlCinema->ajoutRole(); break;
        case "ajoutRoleAffichage" : $ctrlCinema->ajoutRoleAffichage(); break;
        case "ajoutActeur" : $ctrlCinema->ajoutActeur(); break;
        case "ajoutActeurAffichage" : $ctrlCinema->ajoutActeurAffichage(); break;
        case "ajoutRealisateur" : $ctrlCinema->ajoutRealisateur(); break;
        case "ajoutRealisateurAffichage" : $ctrlCinema->ajoutRealisateurAffichage(); break;

    }
}