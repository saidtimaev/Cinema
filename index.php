

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
        case "listeGenres" : $ctrlCinema->listeActeurs(); break;
        case "listeRoles" : $ctrlCinema->listeActeurs(); break;

    }
}