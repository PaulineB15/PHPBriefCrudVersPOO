<?php

/* Classe Database
* Pour se connecter à la BDD
 * Simplification de l'utilisation de PDO
 * Bien gérer les ressources (pattern Singleton)
 * */
class Database {

    // Propriété privée accessible que depuis la classe Database
    private PDO $pdoConnexion;

    // Constructeur ( méthode qui est appelée automatiquement 
    //quand on crée une nouvelle instance de la classe Database)
    public function __construct() {
        // Information de connexion à la base de donnée MySQL
        $host = "localhost"; // sans le port
        $dbname = "brief2phppdo"; // Nom de la BDD
        $user = "root";
        $password = ""; 

        try {
            // Création d'un nouvel "object" de connexion PDO (Php Data Object - interface)
            // Lien avec la BDD
            $this->pdoConnexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
  
            // Confirguration de PDO en cas d'exception (alerte rouge) si erreur SQL
            $this->pdoConnexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Variable $e ->  toutes les infos sur l'erreur (heure, ligne de code, raison erreur etc.)
            // En cas d'erreur
        die("Erreur de connexion : " . $e->getMessage());
            // Fonction die() - stoppe immédiatement l'exécution de toute la page PHP
            // $e->getMessage() - Afficher l'erreur à l'écran   
    }
}
    // LE GETTER (Pour pouvoir utiliser $pdo à l'extérieur de la classe)
    public function getPDO() {
        return $this->pdoConnexion;
    }
}

?>

