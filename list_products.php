<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// --- Récupérer statistiques ---
$stmtCount = $pdo->prepare("SELECT COUNT(*) FROM products WHERE user_id = ?");
$stmtCount->execute([$user_id]);
$total_products = $stmtCount->fetchColumn();

$stmtImages = $pdo->prepare("SELECT COUNT(*) FROM product_images p 
                             JOIN products pr ON p.product_id = pr.id 
                             WHERE pr.user_id = ?");
$stmtImages->execute([$user_id]);
$total_images = $stmtImages->fetchColumn();

// --- Liste des produits ---
$stmt = $pdo->prepare("
    SELECT p.*, 
           c.name AS category,
           (SELECT image_path FROM product_images WHERE product_id = p.id LIMIT 1) AS main_image
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE p.user_id = ?
    ORDER BY p.id DESC
");
$stmt->execute([$user_id]);
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - Auto Market</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4">

    <h2 class="mb-4">🚗 Tableau de bord</h2>

    <div class="row text-center">

        <div class="col-md-4">
            <div class="card shadow-sm border-success mb-3">
                <div class="card-body">
                    <h3 class="text-success"><?= $total_products ?></h3>
                    <p>Annonces publiées</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm border-primary mb-3">
                <div class="card-body">
                    <h3 class="text-primary"><?= $total_images ?></h3>
                    <p>Photos enregistrées</p>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <a href="add_product.php" class="btn btn-success w-100 py-3 shadow">
                ➕ Ajouter une annonce
            </a>
        </div>

    </div>

    <hr class="my-4">

    <h4 class="mb-3">📦 Vos annonces</h4>

    <?php if (empty($products)): ?>
        <div class="alert alert-info">Vous n'avez encore publié aucune annonce.</div>
    <?php else: ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Photo</th>
                        <th>Titre</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                <?php foreach ($products as $p): ?>
                    <tr>
                        <td>
                            <?php if ($p['main_image']): ?>
                                <img src="<?= $p['main_image'] ?>" width="70" height="60" class="rounded">
                            <?php else: ?>
                                <span class="text-muted">Aucune</span>
                            <?php endif; ?>
                        </td>

                        <td><?= htmlspecialchars($p['title']) ?></td>

                        <td><span class="badge bg-success"><?= number_format($p['price'], 0, ',', ' ') ?> FCFA</span></td>

                        <td><?= htmlspecialchars($p['category']) ?></td>

                        <td><?= $p['created_at'] ?></td>

                        <td>
                            <a class="btn btn-sm btn-primary" href="edit_product.php?id=<?= $p['id'] ?>">Modifier</a>
                            <a class="btn btn-sm btn-danger" href="delete_product.php?id=<?= $p['id'] ?>" 
                               onclick="return confirm('Supprimer cette annonce ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary mt-3">⬅ Retour à l'accueil</a>

</div>

</body>
</html>
