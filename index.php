<?php

// Importation des classes produits + database
require_once 'database.php';
require_once 'produit.php';

// Instancie (fabrique) la BDD
$maDb = new Database();

// Instancie le gestionnaire de produits en lui injectant la connexion
$gestionProduits = new Produit($maDb->getPDO());

// Utilise la méthode lister() pour récupérer le tableau des produits
$produits = $gestionProduits->lister();
?>


<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD en POO</title>
    <link href="index.css" rel="stylesheet">
</head>

<body>
    <h1>Articles de sport</h1>

    <a href="ajouter.php">
            <button>Ajouter un produit</button>
        </a>

    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Stock</th>
            <th>Actions</th>
        </tr>
        </thead>

        <tbody>

            <!--foreach - récupère (id, nom, prix et stock) de la BDD pour chaque produits-->
            <?php foreach ($produits as $produit) : ?>
            <tr>
                <!-- htmlspecialchars est là pour la sécurité (empêche les failles XSS) -->
                <td><?= htmlspecialchars ($produit['id']) ?></td>
                <td><?= htmlspecialchars ($produit['nom']) ?></td>
                <td><?= htmlspecialchars ($produit['prix']) ?></td>
                <td><?= htmlspecialchars ($produit['stock']) ?></td>
                <td>
                    <a href="modifier.php?id=<?= htmlspecialchars($produit['id']) ?>"><button>Modifier</button></a>
                    <a href="supprimer.php?id=<?= htmlspecialchars($produit['id']) ?>"><button>Supprimer</button></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
        
            

</body>
</html>