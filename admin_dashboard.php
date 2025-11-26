<?php
session_start();
require_once 'db.php';

// Vérifier si connecté et admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Accès refusé.");
}

// Récupérer statistiques globales
$total_users = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_products = $pdo->query("SELECT COUNT(*) FROM products")->fetchColumn();
$total_categories = $pdo->query("SELECT COUNT(*) FROM categories")->fetchColumn();
$total_solde = $pdo->query("SELECT SUM(solde) FROM users")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">
    <h2 class="mb-4">🛠️ Admin Dashboard</h2>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3><?= $total_users ?></h3>
                    <p>Utilisateurs</p>
                    <a href="admin_users.php" class="btn btn-sm btn-primary">Gérer</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <p>Solde total</p>
                    <a href="categories.php" class="btn btn-sm btn-primary">Gérer les catégories</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3><?= number_format($total_solde,0,',',' ') ?> FCFA</h3>
                    <p>Solde total</p>
                    <a href="admin_users.php" class="btn btn-sm btn-primary">Modifier</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3><?= $total_products ?></h3>
                    <p>Produits</p>
                    <a href="admin_products.php" class="btn btn-sm btn-primary">Gérer</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3><?= $total_categories ?></h3>
                    <p>Catégories</p>
                    <a href="list_categories.php" class="btn btn-sm btn-primary">Gérer</a>
                </div>
            </div>
        </div>
    </div>

    <a href="index.php" class="btn btn-secondary">⬅ Retour à l'accueil</a>
</div>

</body>
</html>
