<?php

// Un namespace est un dossier virtuel dans lequel on peut ranger des classes, des fonctions et d'autres namespaces
namespace Controller;
use Model\Connect;

class RoleController {

    
    // Lister les rôles
    public function listeRoles(){

        $pdo = Connect::seConnecter();
        $requete = $pdo->query("
            SELECT role_nom, id_role
            FROM role
        ");

        require "view/listes/listeRoles.php";
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
}