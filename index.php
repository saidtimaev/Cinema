

<?php

use Controller\CinemaController;
use Controller\FilmController;


spl_autoload_register(function ($class_name){
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlFilm = new FilmController();

$id = (isset($_GET['id'])) ? filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idFilm = (isset($_GET['id_film'])) ? filter_var($_GET['id_film'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idRole = (isset($_GET['id_role'])) ? filter_var($_GET['id_role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idActeur = (isset($_GET['id_acteur'])) ? filter_var($_GET['id_acteur'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;

if(isset($_GET["action"])){

    


    switch ($_GET["action"]){
        // LISTES

        case "listeFilms" : $ctrlFilm->listeFilms(); break;
        case "listeActeurs" : $ctrlCinema->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlCinema->listeRealisateurs(); break;
        case "listeGenres" : $ctrlCinema->listeGenres(); break;
        case "listeRoles" : $ctrlCinema->listeRoles(); break;
        case "listeCastings" : $ctrlCinema->listeCastings(); break;

        // INFOS
        case "infosFilm" : $ctrlFilm->infosFilm($id); break;
        case "infosActeur" : $ctrlCinema->infosActeur($id); break;
        case "infosRealisateur" : $ctrlCinema->infosRealisateur($id); break;
        case "infosGenre" : $ctrlCinema->infosGenre($id); break;
        case "infosRole" : $ctrlCinema->infosRole($id); break;

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
        case "modificationRole" : $ctrlCinema->modificationRole($id); break;
        case "modificationRoleAffichage" : $ctrlCinema->modificationRoleAffichage($id); break;
        case "modificationGenre" : $ctrlCinema->modificationGenre($id); break;
        case "modificationGenreAffichage" : $ctrlCinema->modificationGenreAffichage($id); break;
        case "modificationActeur" : $ctrlCinema->modificationPersonne($id); break;
        case "modificationActeurAffichage" : $ctrlCinema->modificationActeurAffichage($id); break;
        case "modificationFilm" : $ctrlCinema->modificationFilm($id); break;
        case "modificationFilmAffichage" : $ctrlCinema->modificationFilmAffichage($id); break;

        // SUPPRESSIONS
        case "suppressionFilm" : $ctrlCinema->suppressionFilm($id); break;
        case "suppressionCasting" : $ctrlCinema->suppressionCasting($idFilm, $idRole, $idActeur); break;
        case "suppressionActeur" : $ctrlCinema->suppressionActeur($id); break;
        



        
        // Faille XSS
        

    }
}