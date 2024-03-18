<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class CinemaController{
    

    public function pageAccueil() {

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();
        // On appelle la méthode query() sur de l'objet de la classe PDO
        $requeteSortiesRecentes = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note, film_affiche
            FROM film
            ORDER BY DATE(film_date_sortie) DESC
            LIMIT 5
        ");


        $requeteFilmsMieuxNotes = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note, film_affiche
            FROM film
            ORDER BY film_note DESC
            LIMIT 5
        ");

        $requeteGenres = $pdo->query("
            SELECT genre_libelle, id_genre, genre_affiche
            FROM genre
            LIMIT 5
        ");


        $requeteActeurs = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe, personne_photo
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            LIMIT 5
        ");

        $requeteRealisateurs = $pdo->query("
            SELECT id_realisateur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe, personne_photo
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            LIMIT 5
        ");

        require "view/pageAccueil.php";    
        
    }   
    
    

    

    
}




