<?php

// On utilise différentes classes du namespace Controller
use Controller\CinemaController;
use Controller\FilmController;
use Controller\ActeurController;
use Controller\RealisateurController;
use Controller\PersonneController;
use Controller\GenreController;
use Controller\RoleController;
use Controller\CastingController;


spl_autoload_register(function ($class_name){
    require str_replace("\\", DIRECTORY_SEPARATOR, $class_name) . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlFilm = new FilmController();
$ctrlActeur = new ActeurController();
$ctrlRealisateur = new RealisateurController();
$ctrlPersonne = new PersonneController();
$ctrlGenre = new GenreController();
$ctrlRole = new RoleController();
$ctrlCasting = new CastingController();

$id = (isset($_GET['id'])) ? filter_var($_GET['id'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idFilm = (isset($_GET['id_film'])) ? filter_var($_GET['id_film'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idRole = (isset($_GET['id_role'])) ? filter_var($_GET['id_role'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;
$idActeur = (isset($_GET['id_acteur'])) ? filter_var($_GET['id_acteur'], FILTER_SANITIZE_FULL_SPECIAL_CHARS) : null;



if(isset($_GET["action"])){

    


    switch ($_GET["action"]){
        // LISTES

        case "listeFilms" : $ctrlFilm->listeFilms(); break;
        case "listeActeurs" : $ctrlActeur->listeActeurs(); break;
        case "listeRealisateurs" : $ctrlRealisateur->listeRealisateurs(); break;
        case "listeGenres" : $ctrlGenre->listeGenres(); break;
        case "listeRoles" : $ctrlRole->listeRoles(); break;
        case "listeCastings" : $ctrlCasting->listeCastings(); break;

        // INFOS
        case "infosFilm" : $ctrlFilm->infosFilm($id); break;
        case "infosActeur" : $ctrlActeur->infosActeur($id); break;
        case "infosRealisateur" : $ctrlRealisateur->infosRealisateur($id); break;
        case "infosGenre" : $ctrlGenre->infosGenre($id); break;
        case "infosRole" : $ctrlRole->infosRole($id); break;

        // AJOUTS
        case "ajoutGenre" : $ctrlGenre->ajoutGenre(); break;
        case "ajoutGenreAffichage" : $ctrlGenre->ajoutGenreAffichage(); break;
        case "ajoutRole" : $ctrlRole->ajoutRole(); break;
        case "ajoutRoleAffichage" : $ctrlRole->ajoutRoleAffichage(); break;
        case "ajoutPersonne" : $ctrlPersonne->ajoutPersonne(); break;
        case "ajoutPersonneAffichage" : $ctrlPersonne->ajoutPersonneAffichage(); break;
        case "ajoutFilm" : $ctrlFilm->ajoutFilm(); break;
        case "ajoutFilmAffichage" : $ctrlFilm->ajoutFilmAffichage(); break;
        case "ajoutCasting" : $ctrlCasting->ajoutCasting(); break;
        case "ajoutCastingAffichage" : $ctrlCasting->ajoutCastingAffichage(); break;

        // MODIFICATIONS
        case "modificationRole" : $ctrlRole->modificationRole($id); break;
        case "modificationRoleAffichage" : $ctrlRole->modificationRoleAffichage($id); break;
        case "modificationGenre" : $ctrlGenre->modificationGenre($id); break;
        case "modificationGenreAffichage" : $ctrlGenre->modificationGenreAffichage($id); break;
        case "modificationActeur" : $ctrlActeur->modificationActeur($id); break;
        case "modificationActeurAffichage" : $ctrlActeur->modificationActeurAffichage($id); break;
        case "modificationRealisateur" : $ctrlRealisateur->modificationRealisateur($id); break;
        case "modificationRealisateurAffichage" : $ctrlRealisateur->modificationRealisateurAffichage($id); break;
        case "modificationFilm" : $ctrlFilm->modificationFilm($id); break;
        case "modificationFilmAffichage" : $ctrlFilm->modificationFilmAffichage($id); break;

        // SUPPRESSIONS
        case "supprimerFilm" : $ctrlFilm->supprimerFilm($id); break;
        case "supprimerCasting" : $ctrlCasting->supprimerCasting($idFilm, $idRole, $idActeur); break;
        case "supprimerActeur" : $ctrlActeur->supprimerActeur($id); break;
        case "supprimerRealisateur" : $ctrlRealisateur->supprimerRealisateur($id); break;
        case "supprimerGenre" : $ctrlGenre->supprimerGenre($id); break;
        case "supprimerRole" : $ctrlRole->supprimerRole($id); break;
        
        // PAGE ACCUEIL

        case "pageAccueil" : $ctrlCinema->pageAccueil(); break;



        
        // Faille XSS
        

    } 
} else {

        $ctrlCinema->pageAccueil();
}