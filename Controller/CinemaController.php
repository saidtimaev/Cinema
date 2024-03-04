<?php

namespace Controller;
use Model\Connect;

class CinemaController{

    // Lister les films 
    public function listeFilms(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_film, film_titre, film_date_sortie, film_duree, film_note
            FROM film
        ");

        require "view/listes/listeFilms.php";
    }  
    
    // Lister les acteurs 
    public function listeActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT personne_nom, personne_prenom, personne_date_naissance,personne_sexe
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        ");

        require "view/listes/listeActeurs.php";
    }

    // Lister les réalisateurs 
    public function listeRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT personne_nom, personne_prenom, personne_date_naissance,personne_sexe
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");

        require "view/listes/listeRealisateurs.php";
    }

    // Lister les genres 
    public function listeGenres(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT genre_libelle
            FROM genre
        ");

        require "view/listes/listeGenres.php";
    }

    // Lister les genres 
    public function listeRoles(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT role_nom
            FROM role
        ");

        require "view/listes/listeRoles.php";
    }

    // Afficher infos d'un film 
    public function infosFilm($id){

        $pdo = Connect::seConnecter();

        $requeteInfosFilm = $pdo->prepare("
            SELECT film_titre, film_date_sortie, film_duree, film_note, film_synopsis, personne_nom, personne_prenom
            FROM film 
            INNER JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            INNER JOIN personne ON personne.id_personne = realisateur.id_personne
            WHERE id_film = :id
        ");

        $requeteInfosFilm->execute(["id"=>$id]);

        
        $requeteActeursRoles = $pdo->prepare("
            SELECT personne_prenom, personne_nom, role_nom
            FROM casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE casting_film.id_film = :id
        ");

        $requeteActeursRoles->execute(["id"=>$id]);

        require "view/infos/infosFilm.php";
    }
}