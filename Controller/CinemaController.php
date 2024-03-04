<?php

namespace Controller;
use Model\Connect;

class CinemaController{

    // Lister les films 
    public function listFilms(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT film_titre, film_date_sortie
            FROM film
        ");

        require "view/listFilms.php";
    }    
}