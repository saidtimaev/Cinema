<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class ActeurController {

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

    public function modificationActeurAffichage($id){

        $pdo = Connect::seConnecter();

        $requetePersonne = $pdo->prepare("
                       SELECT personne_prenom, personne_nom, personne_sexe, personne_date_naissance, personne.id_personne, personne_photo
                       FROM personne
                       INNER JOIN acteur ON acteur.id_personne = personne.id_personne
                        WHERE id_acteur = :id_acteur
                    ");

                    $requetePersonne->execute([
                        "id_acteur"=>$id
                    ]);

        $requeteListeCastingsActeur = $pdo->prepare("
            SELECT film_titre, role_nom, personne_prenom, personne_nom
            from casting_film
            INNER JOIN film ON casting_film.id_film = film.id_film
            INNER JOIN role ON casting_film.id_role = role.id_role
            INNER JOIN acteur ON casting_film.id_acteur = acteur.id_acteur
            INNER JOIN personne ON acteur.id_personne = personne.id_personne
            WHERE personne.id_personne = :id_personne
        ");

        $requeteListeCastingsActeur->execute([
            "id_personne"=>$id
        ]);

       
        require "view/modifications/modificationActeur.php";
    }

    public function supprimerActeur($id){

        $pdo = Connect::seConnecter();

        $requeteSupprimerPersonne = $pdo->prepare("
            DELETE 
            FROM acteur
            WHERE id_acteur = :id_acteur
        ");

        $requeteSupprimerPersonne->execute([
            "id_acteur"=>$id
        ]);


        header("Location:index.php?action=listeActeurs");die;
    }


    public function modificationActeur($id){
        

        if(isset($_POST['submit'])){

        // On crée nos variables qui vont récupérer les valeurs qu'on a saisies qui seront filtrées
        $personnePrenom = filter_input(INPUT_POST, "personne_prenom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneNom = filter_input(INPUT_POST, "personne_nom",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneSexe = filter_input(INPUT_POST, "personne_sexe",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $personneDateNaissance = new \DateTime(filter_input(INPUT_POST, "personne_date_naissance",FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $personnePhoto = filter_input(INPUT_POST, "personne_photo",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        
        $pdo = Connect::seConnecter();

        // var_dump($_POST);

        
            
            $requeteModificationPersonne = $pdo->prepare("
                UPDATE personne 
                SET personne_prenom = :personne_prenom, personne_nom = :personne_nom, personne_sexe =:personne_sexe, personne_date_naissance = :personne_date_naissance, personne_photo = :personne_photo
                WHERE id_personne = :id_personne
            ");

            $requeteModificationPersonne->execute([
                "personne_prenom"=> $personnePrenom,
                "personne_nom"=> $personneNom,
                "personne_sexe"=> $personneSexe,
                "personne_date_naissance"=>$personneDateNaissance->format('Y-m-d'),
                "personne_photo"=> $personnePhoto,
                "id_personne"=>$id
            ]);

            
        

        // Si la personne est un acteur et un réalisateur
        if ($_POST["professions"] == "both"){

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier acteur
            $requeteAjoutActeur = $pdo->prepare("
                INSERT INTO acteur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutActeur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier réalisateur
            $requeteAjoutRéalisateur = $pdo->prepare("
                INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutRéalisateur->execute([
                "id_personne"=>$id
            ]);

        } 
        
        if ($_POST["professions"] == "acteur"){

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier acteur
            $requeteAjoutActeur = $pdo->prepare("
                INSERT INTO acteur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutActeur->execute([
                "id_personne"=>$id
            ]);

        } 
        
        if ($_POST["professions"] == "realisateur") {

            $requeteSuppressionRoleActeur = $pdo->prepare("
                DELETE FROM acteur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleActeur->execute([
                "id_personne"=>$id
            ]);

            $requeteSuppressionRoleRealisateur = $pdo->prepare("
                DELETE FROM realisateur
                WHERE id_personne = :id_personne
            ");

            $requeteSuppressionRoleRealisateur->execute([
                "id_personne"=>$id
            ]);

            // On lui attribue le métier réalisateur
            $requeteAjoutRéalisateur = $pdo->prepare("
                INSERT INTO realisateur (id_personne) VALUES (:id_personne) 
            ");

            $requeteAjoutRéalisateur->execute([
                "id_personne"=>$id
            ]);
        }

        header("Location:index.php?action=listeActeurs");die;
        // require "view/modifications/modificationPersonne.php";
        }     
    }
}