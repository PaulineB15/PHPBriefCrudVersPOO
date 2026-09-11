<?php

// Importation des classes produits + database
require_once 'database.php';
require_once 'produit.php';

// Instancie (fabrique) la BDD
$maDb = new Database();

// Instancie le gestionnaire de produits en lui injectant la connexion
$gestionProduits = new Produit($maDb->getPDO());

if ($_SERVER['REQUEST_METHOD'] === "POST"){

$nom = htmlspecialchars(trim($_POST['nom']));
$prix = htmlspecialchars(trim($_POST['prix']));
$stock = htmlspecialchars(trim($_POST['stock']));

// Utilise la méthode ajouter un produit
$gestionProduits->ajouter($nom, $prix, $stock);

// header() - Redirige vers index.php (liste des produits)
        header('Location: index.php');
        // Arrêt du script après redirection
        exit;     
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout de nouveau produits</title>
    <link rel="stylesheet" href="">
</head>

<body>

    <h1>Ajouter une nouvelle référence de produit</h1>

    <!--Renvois les données du formulaire dans la même page ajoutProduit.php -->
    <!-- Cela est plus propre en cas d'erreur de saisie du produit-->
    <form action="ajouter.php" method="post">
        <input type="text" name="nom" placeholder="Nom" required><br><br>
        <input type="number" name="prix" placeholder="Prix" step="0.01" required><br><br>
        <input type="number" name="stock" placeholder="Stock" required><br><br>
        <button type="submit">Ajouter le produit </button>
    </form>

</body>
</html>