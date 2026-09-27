<?php

// Importation des classes produits + database
require_once 'database.php';
require_once 'produit.php';

// Instancie (fabrique) la BDD
$maDb = new Database();

// Instancie le gestionnaire de produits en lui injectant la connexion
$gestionProduits = new Produit($maDb->getPDO());

// Récupére l'identifiant du produit cliqué dans l'URL (GET)
$id = $_GET['id'];

// Utilise la méthode supprimer() pour effacer l'article de la BDD
$gestionProduits->supprimer($id);

// header() - Redirige vers index.php (liste des produits)
header('Location: index.php');
// Arrêt du script après redirection
exit; 
?>