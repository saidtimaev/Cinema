<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class GenreController {

    // Lister les genres 
    public function listeGenres(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT genre_libelle, id_genre
            FROM genre
        ");

        require "view/listes/listeGenres.php";
    }

    // Afficher infos d'un genre
    public function infosGenre($id){

        $pdo = Connect::seConnecter();

        $requeteInfosGenre = $pdo->prepare("
        SELECT genre_libelle, id_genre
        from genre
        WHERE id_genre = :id
        ");

        $requeteInfosGenre->execute(["id"=>$id]);

        
        $requeteFilmsGenre = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM genre_film
            INNER JOIN film on film.id_film = genre_film.id_film
            WHERE genre_film.id_genre = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteFilmsGenre->execute(["id"=>$id]);

        require "view/infos/infosGenre.php";
    }

    // Affichage formulaire ajout genre

    public function ajoutGenreAffichage(){
        require "view/ajouts/ajoutGenre.php";
    }

    // Ajouter un genre
    public function ajoutGenre(){

        if(isset($_POST['submit'])){

            // on crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $genreLibelle = filter_input(INPUT_POST, "genre_libelle",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
    
            // Si tous les champs on bien été remplis
            if($genreLibelle){
               
            }
        }   
        // var_dump($genre);
        $pdo = Connect::seConnecter();

        $requeteAjoutGenre = $pdo->prepare("
            INSERT INTO genre (genre_libelle) VALUE (:genre_libelle)
        ");

        $requeteAjoutGenre->execute(["genre_libelle"=>$genreLibelle]);

        require "view/ajouts/ajoutGenre.php";
    }

    public function modificationGenreAffichage($id){

        $pdo = Connect::seConnecter();

        $requeteGenre = $pdo->prepare("
            SELECT genre_libelle
            FROM genre 
            WHERE id_genre = :id_genre
        ");

        $requeteGenre->execute([
            "id_genre"=>$id
        ]);

        require "view/modifications/modificationGenre.php";
    }




    public function modificationGenre($id){
        

        if(isset($_POST['submit'])){
            $genreLibelle = filter_input(INPUT_POST, "genre_libelle",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::seConnecter();

            $requeteGenreLibelle = $pdo->prepare("
                UPDATE genre    
                SET genre_libelle = :genre_libelle
                WHERE id_genre = :id_genre
            ");

            $requeteGenreLibelle->execute([
                "genre_libelle"=>$genreLibelle,
                "id_genre"=>$id
            ]);

        }

        header("Location:index.php?action=modificationGenreAffichage&id=".$id);die;

    }   

    public function supprimerGenre($id){


        $pdo = Connect::seConnecter();

        $requeteSupprimerGenre = $pdo->prepare("
            DELETE 
            FROM genre
            WHERE id_genre = :id_genre
        ");

        $requeteSupprimerGenre->execute([
            "id_genre"=>$id
        ]);

        header("Location:index.php?action=listeGenres");die;
    }
}