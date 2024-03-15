<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class FilmController {

    private $pdo;

    public function __construct() {
        $this->pdo = Connect::seConnecter();
    }

     // Lister les films 
     public function listeFilms() {

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        // $pdo = Connect::seConnecter();
        // On appelle la méthode query() sur de l'objet de la classe PDO
        $requete = $this->pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note
            FROM film
        ");

        //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
        require "view/listes/listeFilms.php";

        // include ""; inclut le contenu d'un autre fichier appelé, mais ne provoque pas d'erreur bloquante s'il est indisponible
        
    }  

    // Afficher infos d'un film 
    public function infosFilm($id){

        // $pdo = Connect::seConnecter();

        $requeteInfosFilm = $this->pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, film_duree, film_note, film_synopsis
            FROM film 
            WHERE id_film = :id
        ");

        $requeteInfosFilm->execute(["id"=>$id]);

        
        $requeteInfosRealisateurFilm = $this->pdo->prepare("
            SELECT CONCAT(personne_prenom, ' ', personne_nom) AS realisateurFilm
            FROM film 
            LEFT JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            LEFT JOIN personne ON personne.id_personne = realisateur.id_personne
            WHERE id_film = :id
        ");

        $requeteInfosRealisateurFilm->execute(["id"=>$id]);

        
        $requeteActeursRoles = $this->pdo->prepare("
            SELECT casting_film.id_film, casting_film.id_role, casting_film.id_acteur, personne_prenom, personne_nom, role_nom
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

    public function ajoutFilmAffichage(){
        $pdo = Connect::seConnecter();
    
        $requeteListeGenres = $pdo->query("
            SELECT genre_libelle, id_genre
            FROM genre
            ORDER BY genre_libelle
        ");
    
        $requeteListeRealisateurs = $pdo->query("
            SELECT id_realisateur, personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
            ORDER BY personne_nom
        ");

        require "view/ajouts/ajoutFilm.php";
    }

    public function ajoutFilm(){

        if(isset($_POST['submit'])){

            // var_dump($_POST);
            // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $filmTitre = filter_input(INPUT_POST, "film_titre",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmSynopsis = filter_input(INPUT_POST, "film_synopsis",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmDateSortie = new \DateTime(filter_input(INPUT_POST, "film_date_sortie",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $filmNote = filter_input(INPUT_POST, "film_note",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmAffiche = filter_input(INPUT_POST, "film_affiche",FILTER_SANITIZE_URL);
            $filmDuree = filter_input(INPUT_POST, "film_duree",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmIdRealisateur = filter_input(INPUT_POST, "id_realisateur",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmGenres = filter_input(INPUT_POST, "genres", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
            
            // var_dump($filmGenres);die;

            $pdo = Connect::seConnecter();

            $requeteAjoutFilm = $pdo->prepare("
                INSERT INTO film ( film_titre, film_synopsis, film_date_sortie, film_note, film_affiche, film_duree, id_realisateur) 
                VALUES ( :film_titre, :film_synopsis, :film_date_sortie, :film_note, :film_affiche, :film_duree, :id_realisateur)
            ");

            $requeteAjoutFilm->execute([
                "film_synopsis"=>$filmSynopsis,
                "film_titre"=>$filmTitre,
                "film_date_sortie"=>$filmDateSortie->format('Y-m-d'),
                "film_note"=>$filmNote,
                "film_affiche"=>$filmAffiche,
                "film_duree"=>$filmDuree,
                "id_realisateur"=>$filmIdRealisateur
            ]);

           // Retourne l'id de la dernière ligne insérée 
            $idFilm = $pdo->lastInsertId();

            $requeteListeGenres = $pdo->query("
                SELECT genre_libelle, id_genre
                FROM genre
                ORDER BY genre_libelle
            ");
    
            $requeteListeRealisateurs = $pdo->query("
                SELECT id_realisateur, personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
                FROM realisateur
                INNER JOIN personne ON realisateur.id_personne = personne.id_personne
                ORDER BY personne_nom
            ");

      
            
          
            

            foreach($filmGenres as $filmGenre){
                
                $requeteAjoutGenreFilm = $pdo->prepare("
                    INSERT INTO genre_film (id_film, id_genre) VALUES (:id_film, :id_genre)
                ");

                $requeteAjoutGenreFilm->execute([
                    "id_film"=>$idFilm,
                    "id_genre"=>$filmGenre
                ]);

            }
          
            
            
        }

        require "view/ajouts/ajoutFilm.php";
    }

    public function modificationFilmAffichage($id){

        $pdo = Connect::seConnecter();

        $requeteInfosFilm = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, film_duree, film_note, film_synopsis, film_affiche
            FROM film 
            WHERE id_film = :id
        ");

        $requeteInfosFilm->execute(["id"=>$id]);

        
        $requeteInfosRealisateurFilm = $pdo->prepare("
            SELECT CONCAT(personne_prenom, ' ', personne_nom) AS realisateurFilm
            FROM film 
            LEFT JOIN realisateur ON film.id_realisateur = realisateur.id_realisateur
            LEFT JOIN personne ON personne.id_personne = realisateur.id_personne
            WHERE id_film = :id
        ");

        $requeteInfosRealisateurFilm->execute(["id"=>$id]);

        $requeteListeGenres = $pdo->query("
            SELECT genre_libelle, id_genre
            FROM genre
            ORDER BY genre_libelle
        ");

        $requeteListeRealisateurs = $pdo->query("
        SELECT id_realisateur, personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
        FROM realisateur
        INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ORDER BY personne_nom
        ");

        $requeteRechercheGenresFilm = $pdo->prepare("
            SELECT id_genre
            FROM genre_film
            WHERE id_film = :id_film
        ");

        $requeteRechercheGenresFilm->execute([
            "id_film"=>$id
        ]);

        $requeteRealisateurFilm = $pdo->prepare("
                SELECT id_realisateur
                FROM film
                WHERE id_film = :id_film
            ");

        $requeteRealisateurFilm->execute([
            "id_film"=>$id
        ]);

        $requeteActeursRoles = $pdo->prepare("
            SELECT casting_film.id_film, casting_film.id_role, casting_film.id_acteur, personne_prenom, personne_nom, role_nom
            FROM casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE casting_film.id_film = :id
        ");

        $requeteActeursRoles->execute(["id"=>$id]);
        

        require "view/modifications/modificationFilm.php";

    }

    public function modificationFilm($id){

        if(isset($_POST['submit'])){

            // var_dump($_POST);
            // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $filmTitre = filter_input(INPUT_POST, "film_titre",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmSynopsis = filter_input(INPUT_POST, "film_synopsis",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmDateSortie = new \DateTime(filter_input(INPUT_POST, "film_date_sortie",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            $filmNote = filter_input(INPUT_POST, "film_note",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmAffiche = filter_input(INPUT_POST, "film_affiche",FILTER_SANITIZE_URL);
            $filmDuree = filter_input(INPUT_POST, "film_duree",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmIdRealisateur = filter_input(INPUT_POST, "id_realisateur",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $filmGenres = filter_input(INPUT_POST, "genres", FILTER_VALIDATE_INT, FILTER_REQUIRE_ARRAY);
            
            // var_dump($filmGenres);die;

            $pdo = Connect::seConnecter();

            $requeteModificationFilm = $pdo->prepare("
                UPDATE film 
                SET film_titre = :film_titre, film_synopsis = :film_synopsis, film_date_sortie = :film_date_sortie, film_note = :film_note, film_affiche = :film_affiche, film_duree = :film_duree, id_realisateur = :id_realisateur
                WHERE id_film = :id_film
            ");

            $requeteModificationFilm->execute([
                "film_synopsis"=>$filmSynopsis,
                "film_titre"=>$filmTitre,
                "film_date_sortie"=>$filmDateSortie->format('Y-m-d'),
                "film_note"=>$filmNote,
                "film_affiche"=>$filmAffiche,
                "film_duree"=>$filmDuree,
                "id_realisateur"=>$filmIdRealisateur,
                "id_film"=>$id
            ]);

           // Retourne l'id de la dernière ligne insérée 
            $idFilm = $pdo->lastInsertId();

            $requeteListeGenres = $pdo->query("
                SELECT genre_libelle, id_genre
                FROM genre
                ORDER BY genre_libelle
            ");
    
            

      
            $requeteSuppressionGenresFilm = $pdo->prepare("
                DELETE FROM genre_film
                WHERE id_film = :id_film
            ");

            $requeteSuppressionGenresFilm->execute([
                "id_film"=>$id
            ]);
            
          
            

            foreach($filmGenres as $filmGenre){
                
                $requeteAjoutGenreFilm = $pdo->prepare("
                    INSERT INTO genre_film (id_film, id_genre) VALUES (:id_film, :id_genre)
                ");

                $requeteAjoutGenreFilm->execute([
                    "id_film"=>$id,
                    "id_genre"=>$filmGenre
                ]);

            }
          
        }


        
        // require "view/modifications/modificationFilm.php";
        header("Location:index.php?action=modificationFilmAffichage&id=$id");die;

    }

    
    public function suppressionFilm($id){
        
        $pdo = Connect::seConnecter();

        $requeteSupprimerFilm = $pdo->prepare("
            DELETE 
            FROM film 
            WHERE id_film = :id_film
        ");

        $requeteSupprimerFilm->execute([
            "id_film"=>$id
        ]);

        header("Location:index.php?action=listeFilms");die;
    }
}