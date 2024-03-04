<?php

namespace Controller;
use Model\Connect;

class CinemaController{

    // Lister les films 
    public function listeFilms(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT film_titre, film_date_sortie, film_duree, film_note
            FROM film
        ");

        require "view/listeFilms.php";
    }  
    
    // Lister les acteurs 
    public function listeActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT personne_nom, personne_prenom, personne_date_naissance,personne_sexe
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        ");

        require "view/listeActeurs.php";
    }

    // Lister les réalisateurs 
    public function listeRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT personne_nom, personne_prenom, personne_date_naissance,personne_sexe
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");

        require "view/listeRealisateurs.php";
    }
}