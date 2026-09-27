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

// Utilise la méthode trouver (index.php) pour récupérer les infos du produit
$produitUpdate = $gestionProduits->trouver($id);

if ($_SERVER['REQUEST_METHOD'] === "POST"){

$nom = (trim($_POST['nom']));
$prix = (trim($_POST['prix']));
$stock = (trim($_POST['stock']));

// Utilise la méthode modifier un produit
$gestionProduits->modifier($id, $nom, $prix, $stock);

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
    <title>Modification de produits</title>
    <link rel="stylesheet" href="">
</head>

<body>
    <!--Renvois les données du formulaire dans la même page -->
    <form action="" method="post">
        <input type="text" name="nom" value="<?= htmlspecialchars($produitUpdate['nom']) ?>" required><br><br>
        <input type="number" name="prix" step="0.01" value="<?= htmlspecialchars($produitUpdate['prix']) ?>" required><br><br>
        <input type="number" name="stock" value="<?= htmlspecialchars($produitUpdate['stock']) ?>" required><br><br>
        <button type="submit">Mise à jour</button>
    </form>

</body>
</html>