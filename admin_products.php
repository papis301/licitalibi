<?php
session_start();
require_once 'db.php';

// Vérification si admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    die("Accès refusé.");
}

// Supprimer produit si demandé
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    // Supprimer toutes les images du produit
    $stmtImages = $pdo->prepare("SELECT image_path FROM product_images WHERE product_id = ?");
    $stmtImages->execute([$id]);
    $images = $stmtImages->fetchAll();
    foreach($images as $img) {
        if(file_exists($img['image_path'])) {
            unlink($img['image_path']);
        }
    }
    $pdo->prepare("DELETE FROM product_images WHERE product_id=?")->execute([$id]);

    // Supprimer produit
    $pdo->prepare("DELETE FROM products WHERE id=?")->execute([$id]);

    header("Location: admin_products.php");
    exit;
}

// Récupérer tous les produits avec catégorie et utilisateur
$stmt = $pdo->query("
    SELECT p.*, c.name AS category_name, u.username, 
           (SELECT image_path FROM product_images WHERE product_id = p.id LIMIT 1) AS main_image
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    LEFT JOIN users u ON p.user_id = u.id
    ORDER BY p.created_at DESC
");
$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Produits</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .product-img { width: 80px; height: 60px; object-fit: cover; }
    </style>
</head>
<body class="p-4">

<h2>📦 Gérer tous les produits</h2>

<a href="add_product.php" class="btn btn-success mb-3">➕ Ajouter un produit</a>

<table class="table table-striped table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Photo</th>
            <th>Titre</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($products as $p): ?>
        <tr>
            <td>
                <?php if($p['main_image']): ?>
                    <img src="<?= $p['main_image'] ?>" class="product-img rounded">
                <?php else: ?>
                    <span class="text-muted">Aucune</span>
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($p['title']) ?></td>
            <td><?= number_format($p['price'],0,',',' ') ?> FCFA</td>
            <td><?= htmlspecialchars($p['category_name'] ?? 'Aucune') ?></td>
            <td><?= htmlspecialchars($p['username']) ?></td>
            <td><?= $p['created_at'] ?></td>
            <td>
                <a href="edit_product.php?id=<?= $p['id'] ?>" class="btn btn-sm btn-primary">Modifier</a>
                <a href="admin_products.php?delete=<?= $p['id'] ?>" 
                   onclick="return confirm('Supprimer ce produit ?')" 
                   class="btn btn-sm btn-danger">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="admin_dashboard.php" class="btn btn-secondary mt-3">⬅ Retour Admin</a>

</body>
</html>
