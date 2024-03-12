

<?php

use Controller\CinemaController;


spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
if(isset($_GET["action"])){

    


    switch ($_GET["action"]){
        // LISTES
        case "listeFilms" : $ctrlCinema->listeFilms(); break;
        case "listeActeurs" : $ctrlCinema->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlCinema->listeRealisateurs(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "listeRoles" : $ctrlCinema->listeRoles(); break;
        case "listeCastings" : $ctrlCinema->listeCastings(); break;
        // INFOS
        case "infosFilm" : $ctrlCinema->infosFilm($_GET['id']); break;
        case "infosActeur" : $ctrlCinema->infosActeur($_GET['id']); break;
        case "infosRealisateur" : $ctrlCinema->infosRealisateur($_GET['id']); break;
        case "infosGenre" : $ctrlCinema->infosGenre($_GET['id']); break;
        case "infosRole" : $ctrlCinema->infosRole($_GET['id']); break;
        // AJOUTS
        case "ajoutGenre" : $ctrlCinema->ajoutGenre(); break;
        case "ajoutGenreAffichage" : $ctrlCinema->ajoutGenreAffichage(); break;
        case "ajoutRole" : $ctrlCinema->ajoutRole(); break;
        case "ajoutRoleAffichage" : $ctrlCinema->ajoutRoleAffichage(); break;
        case "ajoutPersonne" : $ctrlCinema->ajoutPersonne(); break;
        case "ajoutPersonneAffichage" : $ctrlCinema->ajoutPersonneAffichage(); break;
        case "ajoutFilm" : $ctrlCinema->ajoutFilm(); break;
        case "ajoutFilmAffichage" : $ctrlCinema->ajoutFilmAffichage(); break;
        case "ajoutCasting" : $ctrlCinema->ajoutCasting(); break;
        case "ajoutCastingAffichage" : $ctrlCinema->ajoutCastingAffichage(); break;
        // MODIFICATIONS
        case "modificationRole" : $ctrlCinema->modificationRole($_GET['id']); break;
        case "modificationRoleAffichage" : $ctrlCinema->modificationRoleAffichage($_GET['id']); break;
        case "modificationGenre" : $ctrlCinema->modificationGenre($_GET['id']); break;
        case "modificationGenreAffichage" : $ctrlCinema->modificationGenreAffichage($_GET['id']); break;
        case "modificationPersonne" : $ctrlCinema->modificationPersonne($_GET['id']); break;
        case "modificationPersonneAffichage" : $ctrlCinema->modificationPersonneAffichage($_GET['id']); break;


        
        // Faille XSS
        

    }
}