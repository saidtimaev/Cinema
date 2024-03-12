<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class CinemaController{

    // Lister les films 
    public function listeFilms(){

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();
        // On appelle la méthode query() sur de l'objet de la classe PDO
        $requete = $pdo->query("
            SELECT id_film, film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, TIME_FORMAT(SEC_TO_TIME(film_duree*60), '%H:%i') as film_duree, film_note
            FROM film
        ");

        //  inclut le contenu d'un autre fichier appelé, et provoque une erreur bloquante s'il est indisponible
        require "view/listes/listeFilms.php";

        // include ""; inclut le contenu d'un autre fichier appelé, mais ne provoque pas d'erreur bloquante s'il est indisponible
        
    }  
    
    // Lister les acteurs 
    public function listeActeurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
        ");

        require "view/listes/listeActeurs.php";
    }

    // Lister les réalisateurs 
    public function listeRealisateurs(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT id_realisateur, personne_nom, personne_prenom, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance ,personne_sexe
            FROM realisateur
            INNER JOIN personne ON realisateur.id_personne = personne.id_personne
        ");

        require "view/listes/listeRealisateurs.php";
    }

    // Lister les genres 
    public function listeGenres(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT genre_libelle, id_genre
            FROM genre
        ");

        require "view/listes/listeGenres.php";
    }

    // Lister les genres 
    public function listeRoles(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT role_nom, id_role
            FROM role
        ");

        require "view/listes/listeRoles.php";
    }

    // Lister les castings
    public function listeCastings(){
        $pdo = Connect::seConnecter();
        $requeteListeCastings = $pdo->query("
            SELECT film_titre, role_nom, personne_prenom, personne_nom
            from casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            
        ");

        require "view/listes/listeCastings.php";
    }

    // Afficher infos d'un film 
    public function infosFilm($id){

        $pdo = Connect::seConnecter();

        $requeteInfosFilm = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%d/%m/%Y') as film_date_sortie, film_duree, film_note, film_synopsis, personne_nom, personne_prenom
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

    // Afficher infos d'un acteur
    public function infosActeur($id){

        $pdo = Connect::seConnecter();

        $requeteInfosActeur = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance
        FROM personne
        INNER JOIN acteur ON acteur.id_personne = personne.id_personne
        WHERE acteur.id_acteur = :id
        ");

        $requeteInfosActeur->execute(["id"=>$id]);

        
        $requeteActeurCastings = $pdo->prepare("
            SELECT personne_prenom, personne_nom, role_nom, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE casting_film.id_acteur = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteActeurCastings->execute(["id"=>$id]);

        require "view/infos/infosActeur.php";
    }

    // Afficher infos d'un réalisateur
    public function infosRealisateur($id){

        $pdo = Connect::seConnecter();

        $requeteInfosRealisateur = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, DATE_FORMAT(personne_date_naissance, '%d/%m/%Y') as personne_date_naissance
        FROM personne
        INNER JOIN realisateur ON realisateur.id_personne = personne.id_personne
        WHERE realisateur.id_realisateur = :id
        ");

        $requeteInfosRealisateur->execute(["id"=>$id]);

        
        $requeteRealisateurFilms = $pdo->prepare("
            SELECT film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
            FROM film
            WHERE film.id_realisateur = :id
            ORDER BY film_date_sortie DESC
        ");

        $requeteRealisateurFilms->execute(["id"=>$id]);

        require "view/infos/infosRealisateur.php";
    }

    // Afficher infos d'un genre
    public function infosGenre($id){

        $pdo = Connect::seConnecter();

        $requeteInfosGenre = $pdo->prepare("
        SELECT genre_libelle
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

    // Afficher infos d'un rôle
    public function infosRole($id){

        $pdo = Connect::seConnecter();

        $requeteInfosRole = $pdo->prepare("
        SELECT role_nom, id_role
        from role
        WHERE id_role = :id
        ");

        $requeteInfosRole->execute(["id"=>$id]);

        
        $requeteActeursRole = $pdo->prepare("
        SELECT personne_prenom, personne_nom, personne_sexe, film_titre, DATE_FORMAT(film_date_sortie, '%Y') as film_date_sortie
        FROM casting_film
        INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
        INNER JOIN personne ON acteur.id_personne = personne.id_personne
        INNER JOIN film ON film.id_film = casting_film.id_film
        WHERE id_role = :id
        ORDER BY film_date_sortie DESC
        ");

        $requeteActeursRole->execute(["id"=>$id]);

        require "view/infos/infosRole.php";
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
        var_dump($genre);
        $pdo = Connect::seConnecter();

        $requeteAjoutGenre = $pdo->prepare("
            INSERT INTO genre (genre_libelle) VALUE (:genre_libelle)
        ");

        $requeteAjoutGenre->execute(["genre_libelle"=>$genreLibelle]);

        require "view/ajouts/ajoutGenre.php";
    }


    // Affichage formulaire ajout rôle

    public function ajoutRoleAffichage(){
        require "view/ajouts/ajoutRole.php";
    }

    // Ajouter un rôle
    public function ajoutRole(){

        if(isset($_POST['submit'])){

            // on crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $roleNom = filter_input(INPUT_POST, "role_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            
    
            // Si tous les champs on bien été remplis
            if($roleNom){
              
            }
        }   

        $pdo = Connect::seConnecter();

        $requeteAjoutRole = $pdo->prepare("
            INSERT INTO role (role_nom) VALUE (:role_nom)
        ");

        
        $requeteAjoutRole->execute(["role_nom"=>$roleNom]);

        require "view/ajouts/ajoutRole.php";
    }

    // Affichage formulaire ajout personne

    public function ajoutPersonneAffichage(){
        require "view/ajouts/ajoutPersonne.php";
    }

    // Ajouter une personne
    public function ajoutPersonne(){

        if(isset($_POST['submit'])){

            // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
            $personnePrenom = filter_input(INPUT_POST, "personne_prenom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $personneNom = filter_input(INPUT_POST, "personne_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $personneSexe = filter_input(INPUT_POST, "personne_sexe",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $personneDateNaissance = new \DateTime(filter_input(INPUT_POST, "personne_date_naissance",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
            
            $pdo = Connect::seConnecter();

            // Si la personne est un acteur et un réalisateur
            if ($_POST["professions"] == "both"){

                $requeteAjoutPersonne = $pdo->prepare("
                    INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                    VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                ");

                $requeteAjoutPersonne->execute([
                    "personne_prenom"=> $personnePrenom,
                    "personne_nom"=> $personneNom,
                    "personne_sexe"=> $personneSexe,
                    "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                ]);

                // Retourne l'id de la dernière ligne insérée 
                $idPersonne = $pdo->lastInsertId();

                // On lui attribue le métier acteur
                $requeteAjoutActeur = $pdo->prepare("
                    INSERT INTO acteur (id_personne) VALUES (:id_personne) 
                ");

                $requeteAjoutActeur->execute([
                    "id_personne"=>$idPersonne
                ]);

                // On lui attribue le métier réalisateur
                $requeteAjoutRéalisateur = $pdo->prepare("
                    INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
                ");

                $requeteAjoutRéalisateur->execute([
                    "id_personne"=>$idPersonne
                ]);

            } elseif ($_POST["professions"] == "acteur"){

                $requeteAjoutPersonne = $pdo->prepare("
                    INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                    VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                ");

                $requeteAjoutPersonne->execute([
                    "personne_prenom"=> $personnePrenom,
                    "personne_nom"=> $personneNom,
                    "personne_sexe"=> $personneSexe,
                    "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                ]);

                // Retourne l'id de la dernière ligne insérée 
                $idPersonne = $pdo->lastInsertId();

                // On lui attribue le métier acteur
                $requeteAjoutActeur = $pdo->prepare("
                    INSERT INTO acteur (id_personne) VALUES (:id_personne) 
                ");

                $requeteAjoutActeur->execute([
                    "id_personne"=>$idPersonne
                ]);
    
            } else {

                $requeteAjoutPersonne = $pdo->prepare("
                    INSERT INTO personne (personne_prenom, personne_nom, personne_sexe, personne_date_naissance) 
                    VALUES (:personne_prenom, :personne_nom, :personne_sexe, :personne_date_naissance)
                ");

                $requeteAjoutPersonne->execute([
                    "personne_prenom"=> $personnePrenom,
                    "personne_nom"=> $personneNom,
                    "personne_sexe"=> $personneSexe,
                    "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d')
                ]);
    
                // Retourne l'id de la dernière ligne insérée 
                $idPersonne = $pdo->lastInsertId();

                // On lui attribue le métier réalisateur
                $requeteAjoutRéalisateur = $pdo->prepare("
                    INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
                ");

                $requeteAjoutRéalisateur->execute([
                    "id_personne"=>$idPersonne
                ]);
            }
        }   

        require "view/ajouts/ajoutPersonne.php";
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

    public function ajoutCastingAffichage(){

        // On appelle la méthode statique seConnecter de la classe Connect qui instancie un objet PDO stocké dans $pdo
        $pdo = Connect::seConnecter();

        // Pour récupèrer la liste des films
        $requeteListeFilms = $pdo->query("
            SELECT id_film, film_titre
            FROM film
            ORDER BY film_titre
        ");

        // Pour récupèrer la liste des rôles
        $requeteListeRoles = $pdo->query("
            SELECT role_nom, id_role
            FROM role
            ORDER BY role_nom
        ");

        $requeteListeActeurs = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY personne_nom
        ");

        require "view/ajouts/ajoutCasting.php";

    }

    public function ajoutCasting(){
        // var_dump($_POST);die;
        if(isset($_POST['submit'])){

            $idFilm = filter_input(INPUT_POST, "film",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idRole = filter_input(INPUT_POST, "role",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $idActeur = filter_input(INPUT_POST, "acteur",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::seConnecter();

            // Pour récupèrer la liste des films
        $requeteListeFilms = $pdo->query("
        SELECT id_film, film_titre
        FROM film
        ORDER BY film_titre
        ");

        // Pour récupèrer la liste des rôles
        $requeteListeRoles = $pdo->query("
            SELECT role_nom, id_role
            FROM role
            ORDER BY role_nom
        ");

        $requeteListeActeurs = $pdo->query("
            SELECT id_acteur,personne_nom, personne_prenom
            FROM acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            ORDER BY personne_nom
        ");


            $requeteAjoutCasting = $pdo->prepare("
                INSERT INTO casting_film (id_film, id_role, id_acteur) VALUES (:id_film, :id_role, :id_acteur)
            ");

            $requeteAjoutCasting->execute([
                "id_film"=>$idFilm,
                "id_role"=>$idRole,
                "id_acteur"=>$idActeur
            ]);
        }

        require "view/ajouts/ajoutCasting.php";
    }


    public function modificationRoleAffichage($id){

        // reque select role qui a l'id $id

        $pdo = Connect::seConnecter();

        $requeteNomRole = $pdo->prepare("
            SELECT role_nom
            FROM role 
            WHERE id_role = :id_role
        ");

        $requeteNomRole->execute([
            "id_role"=>$id
        ]);

        // renvoie variable role dans la vue 
        require "view/modifications/modificationRole.php";
    }




    public function modificationRole($id){
        

        if(isset($_POST['submit'])){
            $roleNom = filter_input(INPUT_POST, "role_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $pdo = Connect::seConnecter();

            $requeteNomRole = $pdo->prepare("
                UPDATE role
                SET role_nom = :role_nom
                WHERE id_role = :id_role
            ");

            $requeteNomRole->execute([
                "role_nom"=>$roleNom,
                "id_role"=>$id
            ]);

        }

        header("Location:index.php?action=modificationRoleAffichage&id=".$id);
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

        header("Location:index.php?action=modificationGenreAffichage&id=".$id);

}   
}
