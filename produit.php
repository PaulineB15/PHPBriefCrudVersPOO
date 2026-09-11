<?php

class Produit {

    // Propriété pour stocker la connexion
    private $pdo;

    // Constructeur -> demande la connexion en paramètre    
    public function __construct(PDO $connexionBDD) {
    // On range la connexion reçue dans la propriété privée de la classe    
    $this->pdo = $connexionBDD; 
    }

    // Pour lire (Read) tous les produits
    public function lister() {
        // Préparation de la requête SQL
        $query = "SELECT * FROM produits";
        
        // Exécution avec la propriété privée $this->pdo
        $stmt = $this->pdo->query($query);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Pour ajouter (Create) un produit
    public function ajouter($nom, $prix, $stock) {

        // Préparation de la requête SQL
        $addQuery = "INSERT INTO produits (nom, prix, stock) VALUES (:nom, :prix, :stock)";

        // Exécution avec la propriété privée $this->pdo
        $stmt = $this->pdo->prepare($addQuery);

        // Exécuter en liant les marqueurs (:nom, :prix, :stock) aux vraies variables nettoyées
        $stmt->execute([
        // Contenu de la variable ($nom) -> dans marqueur (:nom)
        ':nom' => $nom,
        ':prix' => $prix,
        ':stock' => $stock
        ]);
    }


    // Pour supprimer (Delete) des produits
    public function supprimer($id) {

        // Prépare la requête pour la suppression 
        $deleteQuery = "DELETE FROM produits WHERE id= :id";
        
        // Exécution avec la propriété privée $this->pdo
        $stmt = $this->pdo->prepare($deleteQuery);
        
        $stmt->execute([
        // Contenu de la variable ($id) -> dans marqueur (:id)
        ':id' => $id
        ]);
    }



    // Pour modifier (Update) des produits
    public function modifier($id, $nom, $prix, $stock) {

        // Prépare la requête pour la modification
        $updateQuery = "UPDATE produits SET nom = :nom, prix = :prix, stock = :stock WHERE id = :id"; 
        
        $stmt = $this->pdo->prepare($updateQuery); 

         //Exécuter en liant TOUS les marqueurs (y compris l'id !)
        $stmt->execute([
            ':nom' => $nom,
            ':prix' => $prix,
            ':stock' => $stock,
            ':id' => $id
        ]);
    }

    // Pour récupérer les infos du produit ( avec l'id)
    public function trouver($id) {

        // Préparation de la requête SQL
        $query = "SELECT * FROM produits WHERE id= :id";

        // Exécution avec la propriété privée $this->pdo
        $stmt = $this->pdo->prepare($query);

         $stmt->execute([
        // Contenu de la variable ($id) -> dans marqueur (:id)
        ':id' => $id
        ]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}

?>