<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->prepare("
    SELECT p.*, c.name AS category_name,
           (SELECT image_path FROM product_images WHERE product_id = p.id LIMIT 1) AS main_image
    FROM products p
    LEFT JOIN categories c ON p.category_id = c.id
    WHERE user_id = ?
    ORDER BY p.id DESC
");
$stmt->execute([$_SESSION['user_id']]);

$products = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Produits</title>
</head>
<body>

<h2>Mes Produits</h2>
<a href="add_product.php">➕ Ajouter un produit</a>

<table border="1" cellpadding="8">
    <tr>
        <th>Image</th>
        <th>Titre</th>
        <th>Prix</th>
        <th>Catégorie</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($products as $p): ?>
    <tr>
        <td>
            <?php if ($p['main_image']): ?>
                <img src="<?= $p['main_image'] ?>" width="80">
            <?php else: ?>
                <span>Aucune image</span>
            <?php endif; ?>
        </td>

        <td><?= htmlspecialchars($p['title']) ?></td>
        <td><?= htmlspecialchars($p['price']) ?> FCFA</td>
        <td><?= htmlspecialchars($p['category_name'] ?? 'Aucune') ?></td>

        <td>
            <a href="edit_product.php?id=<?= $p['id'] ?>">Modifier</a>
            |
            <a href="delete_product.php?id=<?= $p['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
